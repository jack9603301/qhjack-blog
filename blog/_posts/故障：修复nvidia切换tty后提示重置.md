---
title: 故障：修复nvidia切换tty后提示重置
tags:
  - linux
  - nvidia
categories: linux
comments: true
copyright_reprint: false
description: 这是一次故障记录
abbrlink: 3117127336
date: 2022-12-01 13:34:21
---

最近我重新装了gentoo，处于需求我使用了N卡和nvidia专用驱动，发现当我们切换tty时，kwin会提示**由于显卡重置，桌面效果已重启**，其他的opengl程序也一定程度的发生了故障，甚至崩溃，处于完美主义，我决定尝试尽可能的修复这个问题（我也相信nvidia的驱动程序给出了一定的选择）。

我搜索了很多资料，包括google，都未能找到有价值的线索，我甚至都认为这可能是一个很小的bug，目前没有很好的办法解决它。然而我看到了下面的链接：

1. [Preserve video memory after suspend](https://wiki.archlinux.org/title/NVIDIA/Tips_and_tricks#Preserve_video_memory_after_suspend)
2. [当启用MSI中断，驱动程序初始化失败](https://wiki.gentoo.org/wiki/NVIDIA/nvidia-drivers/zh-cn#.E5.BD.93.E5.90.AF.E7.94.A8MSI.E4.B8.AD.E6.96.AD.EF.BC.8C.E9.A9.B1.E5.8A.A8.E7.A8.8B.E5.BA.8F.E5.88.9D.E5.A7.8B.E5.8C.96.E5.A4.B1.E8.B4.A5)
3. [Random_freezes](https://wiki.gentoo.org/wiki/NVIDIA/nvidia-drivers/zh-cn#Random_freezes)

于是我决定孤注一掷，进行如下尝试：

# 修改驱动参数
我按照第1. 2. 进行试验，修改`/etc/modprobe.d/nvidia.conf`文件：

```conf
options nvidia \
        NVreg_DeviceFileGID=27 \
        NVreg_DeviceFileMode=432 \
        NVreg_DeviceFileUID=0 \
        NVreg_ModifyDeviceFiles=1 \
        modeset=1 \
        NVreg_UsePageAttributeTable=1 \
        NVreg_RegistryDwords="OverrideMaxPerf=0x1" \
        NVreg_PreserveVideoMemoryAllocations=1 \
        NVreg_TemporaryFilePath=/tmp/nvidia
```

# 增加compat选项

修改`/etc/portage/package.use/nvidia`:

```conf
x11-drivers/nvidia-drivers tools persistenced compat
```

# 总结

问题居然成功解决，虽然dmesg仍然存在由`nvidia-modeset`发出的警告，但kwin和其他渲染没有问题，我认为这是由于显卡挂起引起的

