---
title: 给Orangepo 3 LTS安装gentoo
taxonomy:
	category:
        - linux
    tag:
        - linux
        - gentoo
hero_classes: 'text-dark title-h1h2 overlay-light hero-large parallax'
hero_image: unsplash-luca-bravo.jpg
blog_url: /blog
show_sidebar: false
show_breadcrumbs: true
show_pagination: true
subtitle: 'finding beauty in structure'
---

大家好，这篇文章，我们来分享一下，如何给Orangepi 3 LTS安装Gentoo

## 硬件配置

### 产品参数

| CPU          | 全志 H6  <br>四核 64 位 1.8GHz 高性能 Cortex-A53 处理器                                                                                                                                                                                    |
| ------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| GPU          | • High-performance multi-core GPU Mali T720<br><br>• OpenGL ES3.1/3.0/2.0/1.1<br><br>• Microsoft DirectX 11 FL9_3<br><br>• ASTC(Adaptive Scalable Texture Compression)<br><br>• Floating point operation greater than 70 GFLOPS |
| 电源管理芯片       | AXP805                                                                                                                                                                                                                          |
| 内存           | 2GB LPDDR3 (与 GPU 共享)                                                                                                                                                                                                           |
| 板载存储         | • TF卡插槽 <br><br> • 8GB EMMC Flash                                                                                                                                                                                               |
| 板载以太网        | • YT8531C芯片<br><br> • 支持10/100M/1000M 以太网                                                                                                                                                                                       |
| 板载WIFI+蓝牙    | • AW859A芯片 <br><br> • 支持IEEE 802.11 a/b/g/n/ac <br><br> • 支持BT5.0                                                                                                                                                               |
| 视频输出         | • HDMI 2.0a <br><br> • TV CVBS Output                                                                                                                                                                                           |
| 音频输出         | • HDMI输出<br><br> • 3.5mm音频口                                                                                                                                                                                                     |
| 电源           | 5V3A Type-C供电                                                                                                                                                                                                                   |
| USB 端口       | 1 * USB 3.0 HOST、2 * USB 2.0 HOST                                                                                                                                                                                               |
| Low-level 外设 | 26pin 接头带有1*I2C、1*SPI、1*UART及多个GPIO口                                                                                                                                                                                            |
| 调试串口         | UART-TX、UART-RX以及GND                                                                                                                                                                                                            |
| 按键           | 电源按键(SW4)                                                                                                                                                                                                                       |
| LED灯         | 电源指示灯和状态指示灯                                                                                                                                                                                                                     |
| 红外接收         | 支持红外遥控器                                                                                                                                                                                                                         |
| 支持的操作系统      | Android 9.0、Ubuntu、Debian等操作系统                                                                                                                                                                                                  |

## 构建可引导镜像

1. 单击[Orange Pi - Orangepi](http://www.orangepi.cn/html/hardWare/computerAndMicrocontrollers/service-and-support/Orange-Pi-3-LTS.html)下载官方镜像，本文选择debian。

2. 执行如下指令：

   ```bash
   dd if=<orange_img> of=/dev/sdd
   ```

   执行此命令先烧录，然后执行如下命令挂载到系统：

   ```bash
   sudo mount -o loop,offset=$((8192*512)) ~/下载/Orangepi3-lts_3.0.0_debian_bullseye_server_linux5.16.17.img /mnt/opipc_image
   ```

3. 执行如下命令删除sd卡的所有文件（除了引导文件外）：

   ```bash
   sudo rm -rf *
   ```

4. 执行如下指令拷贝rootfs：

   ```bash
   sudo wget https://bouncer.gentoo.org/fetch/root/all/releases/arm64/autobuilds/20220724T233143Z/stage3-arm64-openrc-20220724T233143Z.tar.xzhttps://bouncer.gentoo.org/fetch/root/all/releases/arm64/autobuilds/20220724T233143Z/stage3-arm64-openrc-20220724T233143Z.tar.xz
   sudo wget http://gentoo.aditsu.net:8000/snapshots/portage-latest.tar.xz
   sudo tar xpvf stage3-*.tar.xz --xattrs-include='*.*' --numeric-owner
   sudo tar xpvf portage-latest.tar.xz --xattrs-include='*.*' --numeric-owner -C /usr
   ```

5. 拷贝官方的引导文件：

   ```bash
   sudo cp -r /mnt/opipc_img/boot/* boot/
   ```

   编辑`boot.cmd`文件，内容如下：

   ```uboot
   # DO NOT EDIT THIS FILE
#
# Please edit /boot/orangepiEnv.txt to set supported parameters
#

# default values
setenv load_addr "0x45000000"
setenv overlay_error "false"
setenv rootdev "/dev/mmcblk0p1"
setenv verbosity "1"
setenv rootfstype "ext4"
setenv console "both"
setenv docker_optimizations "on"
setenv bootlogo "false"

# Print boot source
itest.b *0x10028 == 0x00 && echo "U-boot loaded from SD"
itest.b *0x10028 == 0x02 && echo "U-boot loaded from eMMC or secondary SD"
itest.b *0x10028 == 0x03 && echo "U-boot loaded from SPI"

echo "Boot script loaded from ${devtype}"

if test -e ${devtype} ${devnum} ${prefix}orangepiEnv.txt; then
        load ${devtype} ${devnum} ${load_addr} ${prefix}orangepiEnv.txt
        env import -t ${load_addr} ${filesize}
fi

if test "${console}" = "display" || test "${console}" = "both"; then setenv consoleargs "console=ttyS0,115200 console=tty1"; fi
if test "${console}" = "serial"; then setenv consoleargs "console=ttyS0,115200"; fi
if test "${bootlogo}" = "true"; then setenv consoleargs "bootsplash.bootfile=bootsplash.orangepi ${consoleargs}"; fi

# get PARTUUID of first partition on SD/eMMC it was loaded from
# mmc 0 is always mapped to device u-boot (2016.09+) was loaded from
if test "${devtype}" = "mmc"; then part uuid mmc 0:1 partuuid; fi

setenv bootargs "root=${rootdev} rootwait init=/sbin/init rootfstype=${rootfstype} ${consoleargs} consoleblank=0 loglevel=${verbosity} ubootpart=${partuuid} usb-storage.quirks=${usbstoragequirks} ${extraargs} ${extraboardargs} earlycon=
serial0:115200n8"

if test "${docker_optimizations}" = "on"; then setenv bootargs "${bootargs} cgroup_enable=memory swapaccount=1"; fi

load ${devtype} ${devnum} ${fdt_addr_r} ${prefix}dtb/${fdtfile}
fdt addr ${fdt_addr_r}
fdt resize 65536
for overlay_file in ${overlays}; do
        if load ${devtype} ${devnum} ${load_addr} ${prefix}dtb/allwinner/overlay/${overlay_prefix}-${overlay_file}.dtbo; then
                echo "Applying kernel provided DT overlay ${overlay_prefix}-${overlay_file}.dtbo"
                fdt apply ${load_addr} || setenv overlay_error "true"
        fi
done
for overlay_file in ${user_overlays}; do
        if load ${devtype} ${devnum} ${load_addr} ${prefix}overlay-user/${overlay_file}.dtbo; then
                echo "Applying user provided DT overlay ${overlay_file}.dtbo"
                fdt apply ${load_addr} || setenv overlay_error "true"
        fi
done
if test "${overlay_error}" = "true"; then
        echo "Error applying DT overlays, restoring original DT"
        load ${devtype} ${devnum} ${fdt_addr_r} ${prefix}dtb/${fdtfile}
else
        if load ${devtype} ${devnum} ${load_addr} ${prefix}dtb/allwinner/overlay/${overlay_prefix}-fixup.scr; then
                echo "Applying kernel provided DT fixup script (${overlay_prefix}-fixup.scr)"
                source ${load_addr}
        fi
        if test -e ${devtype} ${devnum} ${prefix}fixup.scr; then
                load ${devtype} ${devnum} ${load_addr} ${prefix}fixup.scr
                echo "Applying user provided fixup script (fixup.scr)"
                source ${load_addr}
        fi
fi

load ${devtype} ${devnum} ${ramdisk_addr_r} ${prefix}uInitrd
load ${devtype} ${devnum} ${kernel_addr_r} ${prefix}Image

booti ${kernel_addr_r} ${ramdisk_addr_r} ${fdt_addr_r}

# Recompile with:
# mkimage -C none -A arm -T script -d /boot/boot.cmd /boot/boot.scr
   ```

并执行如下命令：

```bash
sudo mkimage -C none -A arm64 -T script -d boot.cmd boot.scr
```

## 执行初始化设置

执行以下命令：

```bash
ip addr add 192.168.3.200/24 dev eth0
ip link set eth0 up
ip route add 0.0.0.0/0 via 192.168.3.1
data -s '<data>' # 设置日期
data -s '<time>' # 设置时间
emerge-webrsync
emerge --sync
emerge @world --ask
```

此后还需要编辑`inittab` 以便开启串口控制台的初始化程序。

## 编译Gentoo Linux主线内核

现在我们还只是使用官方的引导内核，现在我们将构建自己的内核，执行如下指令：

```bash
emerge --ask gentoo-sources
emerge --ask dracut
eselect kernel set 1
cd /usr/src/linux
cp /boot/config .config
make menuconfig
make
make modules_install
mv /boot /boot.old
mkdir /boot.new
# 根据需要利用软链接切换，拷贝必要的引导文件（除了内核部分）
dracut --kver=5.15.52-gentoo
```

## 构建uInitrd

从物理机执行如下命令：

```bash
sudo mkimage -C none -A arm64 -T ramdisk -n uInitrd -d <img> uInitrd
```

当你建立好正确的软链接关系后，重新启动，系统正常引导说明成功

## 系统设置完成
