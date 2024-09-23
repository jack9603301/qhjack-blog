---
title: fish shell的配置和使用
tags:
  - linux
  - fish
categories: linux
author: Xie Bruce
comments: true
post_link: 'https://www.xiebruce.top/1811.html'
copyright_reprint: true
description: >-
  我之前写过一篇文章：[Mac/Linux下配置iTerm2+zsh+powerline美化终端窗口](https://www.xiebruce.top/590.html)，文章介绍了使用zsh后，使我们敲命令更加的便捷，看上去也更加的美观。
abbrlink: 2634740317
---
我之前写过一篇文章：[Mac/Linux下配置iTerm2+zsh+powerline美化终端窗口](https://www.xiebruce.top/590.html)，文章介绍了使用zsh后，使我们敲命令更加的便捷，看上去也更加的美观。

本文将介绍另一种很受欢迎的shell，它叫[fish](https://github.com/fish-shell/fish-shell)，它在一些管理和配置上比zsh更方便更好用。

## shell简介

### sh和bash的

- 1、UNIX诞生于1969年，由Bell Labs的Dennis Ritchie和Ken Thompson编写；
- 2、但其实在他们两个编写UNIX之前，他们是跟着贝尔实验室一起参加Multics项目的，Shell的概念、用途、从内核中分离出来单独成为一个用户程序都是在Multics时期有的；
- 3、Thompson在UNIX的开发过程中，写了thompson shell，在1971年，随第一个版本的UNIX发布。路径就是 `/bin/sh`，在thompson shell的时代 ，就已经有了管道、通配符的概念；
- 4、后来，在1979年发布的第7版本UNIX中，sh换成了同是贝尔实验室的Stephen Bourne编写的Bourne sh，后来缩写就是bsh；
- 5、在1980年代，Richard Stallman发起了自由软件运动，目的是为了让人们可以自由的获取和使用软件。在GNU项目中，Brian Fox重写了Shell的部分，取名为Bourne Again Shell，读起来像Born again，重生的意思，这就是我们现在Linux上最多使用的Bash了。

### sh,ash和dash

- 1、目前在debian和ubuntu上，sh其实是一个指向dash的软链接；
- 2、Almquist shell(ash)是一个轻量级的Unix shell，最初由Kenneth Almquist编写于80年代末，它是Bourne shell(bsh)在Unix System V.4系统上的一个变体，在90年代初发行的Unix BSD系统中，它(ash)代替了Bourne shell(bsh)；
- 3、1997年Herbert Xu将ash从NetBSD移植到Debian Linux。2002年9月，在Debian 0.4.1版本中，这个移植被重命名为Dash (Debian Almquist shell)。Xu的主要目的是POSIX一致性和瘦身(即缩减dash的大小)。

### zsh shell简介

Paul Falstad于1990年在普林斯顿大学求学时编写了zsh的初版，zsh这个名称源于耶鲁大学教授邵中(Zhong Shao，后转为普林斯顿大学教授)，保罗将教授的用户名"zsh"作为此Shell的名称。

Zsh对Bourne shell做出了大量改进，同时加入了Bash、ksh及tcsh的某些功能。自2019年起，macOS的默认Shell已从bash改为zsh。zsh有[Oh My Zsh](https://github.com/ohmyzsh/ohmyzsh)插件，该插件能大大提升zsh的使用体验。

### fish有哪些优点

- 1、样式美观且可高度定制，包含选项提示

  ![选项提示.gif](https://img.xiebruce.top/2023/02/28/a7911e20ab80b40c7152d35b602ad451.gif)
- 2、按Tab键可列出当前文件夹下的文件(夹)，继续按可在文件列表中跳转选中(也可直接用方向键选择)；

  ![Tab list.gif](https://img.xiebruce.top/2023/02/28/c99df00716dd35586ed0697b572d2bb5.gif)
- 3、快速回到上一个/下一个文件夹(其实用 `cd -`更方便，zsh也支持 `cd -`)

  ![prevd-nextd.gif](https://img.xiebruce.top/2023/02/28/14373beb3310d356e70e567a9fb8488a.gif)
- 4、能以不同的颜色提示你敲的命令是否存在(不存在是红色，存在的话你可以自己调颜色)

  ![if-command-exists.gif](https://img.xiebruce.top/2023/02/28/76afb66862bbe106e44a7b81bae135c4.gif)
- 5、输入命令时会显示历史执行过的命令，显示后按一下方向键右键，直接就输入了，免去重新输入的麻烦，这里以 `cd`命令为例，但绝不限于cd，任何命令都可以

  ![command-history.gif](https://img.xiebruce.top/2023/02/28/2a91fbc4345e3c4274a66ffb30f46507.gif)
- 6、可以用不同符号显示git分支上发生的一些事，比如有新文件未加入暂存区、加入了暂存区但未提交、全部文件已提交、当前有冲突等等

  ![git status.gif](https://img.xiebruce.top/2023/02/28/eb2758e959ab72623c858aefd5d4b9cb.gif)
- 7、回删更方便，按 `command+w`(macOS)或 `ctrl+w`(Linux)可一段一段的回删(如果bash的话，是直接整段回删的，不能一节一节的删除)

  ![section-del-back.gif](https://img.xiebruce.top/2023/02/17/41a784fb58ae8669f96f50faea386539.gif)
- 8、可定义abbr，一种比alias更好用的命令缩写方法(输入缩写后按空格或回车，它能展开成原形)

  ![abbr.gif](https://img.xiebruce.top/2023/02/28/d6d77cf0e442689de5fd80e1b14de111.gif)
- 9、可以很方便的自定义函数(命令)，就比如最常见的 `cd`,`ls`这些命令，你都可以轻易的重定义，当然你也可以定义你自己的函数(一个函数就是一个命令)。

**fish的缺点**：不兼容bash。

**目前fish的一个bug**：ls或cd之类的命令后面跟上带路径后，按tab，会列出该路径下的所有文件和文件夹，但是fish无法配置文件和文件夹分别显示不同颜色，而zsh默认就是分别显示不同颜色的。

### fish shell简介

fish是一个专注于交互性和可用性的Unix shell，fish这个名称来自于它的英文释义“the friendly interactive shell”，意思是“人机交互非常友好的shell”。Fish被设计为默认为用户提供功能，而不是通过配置。Fish被认为是一个外来的shell，因为它没有严格遵守POSIX shell标准，这是由维护者决定的。

也就是说，很多常见shell命令是无法在fish上执行的，不过无所谓，如果你要执行shell脚本，你可以在里面用 `#!/bin/bash`来指定bash执行，或者直接显式的用bash执行 `bash /path/to/xxx.sh`。

fish首次发布于2005年2月13日，原作者为Axel Liljencrantz，现在在[github](https://github.com/fish-shell/fish-shell)开源，有700多个贡献者。

## fish和oh-my-fish的安装

几个相关链接：[fish官网](https://fishshell.com/)、[fish官方文档](https://fishshell.com/docs/current/index.html)、[fish官方配置文档](https://fishshell.com/docs/current/language.html#configuration)、[fish github](https://github.com/fish-shell/fish-shell)、[oh-my-fish](https://github.com/oh-my-fish/oh-my-fish#installation)。

### 安装fish

在[fish官网](https://fishshell.com/)的“Go fish”部分，有各个系统的安装方法

![](https://img.xiebruce.top/2023/02/27/99d162969d5fd0199554516f1576d10a.jpg)

Ubuntu点Subscribe进去，其它的由于Subscribe和Download同一个链接，就直接点进去就行，其实都是“**先添加源，再用包管理工具安装**”，fedora和archlinux由于它们的包都会比较新，所以无需要额外添加安装源。

---

debian11添加fish安装源并更新

```bash

echo'deb http://download.opensuse.org/repositories/shells:/fish:/release:/3/Debian_11/ /' | sudo tee /etc/apt/sources.list.d/shells:fish:release:3.list

curl -fsSL https://download.opensuse.org/repositories/shells:fish:release:3/Debian_11/Release.key | gpg --dearmor | sudo tee /etc/apt/trusted.gpg.d/shells_fish_release_3.gpg > /dev/null

sudo apt update

```

然后使用apt安装

```bash

apt install fish

```

安装好之后，默认配置文件在 `/etc/fish/`下，但我们修改配置一般不会去该文件夹下修改，而是在自己用户目录下创建配置文件夹 `~/.config/`(不过不需要自己创建，安装oh-my-fish会自动创建，后面会说到)。

---

macOS可以用brew安装

```bash

brew install fish

```

brew安装后也会有配置文件，不过是在 `/usr/local/etc/fish/`下，这是brew安装软件的惯例。

---

无论是macOS还是Linux，安装好之后，都要设置默认shell为fish

```bash

# 首先查看fish被安装在哪儿

which fish


# 然后用切换(记得把/path/to/fish换成which fish输出的路径)

chsh -s /path/to/fish

```

其实该命令就是修改 `/etc/passwd`中用户对应的默认shell，比如以下就是root用户在 `/etc/passwd`文件中的内容，它的最后一段 `/usr/bin/fish`就是登录该用户后默认执行的shell

```bash

root:x:0:0:root:/root:/usr/bin/fish

```

当然macOS用户并不存在 `/etc/passwd`中，而是存在以下文件夹中，一个用户一个plist文件，比如用户名为bruce，则有 `bruce.plist`

```bash

/private/var/db/dslocal/nodes/Default/users/

```

我们用以下命令把bruce.plist拷贝出来，你拷贝的时候换一下自己用户名就行

```bash

# 先切换到超级用户

sudo -s


# 然后进入存储用户数据的文件夹

cd /private/var/db/dslocal/nodes/Default/users/


# 把bruce用户的plist文件拷贝到“下载”文件夹

cp bruce.plist ~/Downloads


# 进入“下载”文件夹

cd ~/Downloads


# 修改刚刚拷贝的文件所有者为当前用户(whoami可以查看当前用户名)

chown bruce:staff bruce.plist

```

现在我们可以查看bruce.plist了，需要用到plist查看软件，我用的是“PlistEdit Pro”，先打开“PlistEdit Pro”，然后把bruce.plist插到“PlistEdit Pro”界面上，就能打开，如下所示，shell已经切换为 `/usr/local/bin/fish`了

![](https://img.xiebruce.top/2023/02/27/5ed4283edc42750cfc1fed67506c824f.jpg)

### 安装oh-my-fish

类似[oh-my-zsh](https://github.com/ohmyzsh/ohmyzsh)，相当于给你提供一个工具，让你能更加方便的配置fish shell。

安装[oh-my-fish](https://github.com/oh-my-fish/oh-my-fish)之前必须安装git(1.9.5以上)和curl，如果你已经安装过了，就忽略这一步

```bash

# Debian/Ubuntu

apt install git curl


# macOS

brew install git curl

```

安装oh-my-fish，由于源码在github，如果没有科学上网，这个很可能会安装失败，具体请看[这里](https://www.xiebruce.top/1061.html#i-2)

```bash

curl https://raw.githubusercontent.com/oh-my-fish/oh-my-fish/master/bin/install | fish

```

- 1、oh-my-fish会被安装到 `~/.local/share/omf/`；
- 2、oh-my-fish安装过程会自动创建 `~/.config/`目录(里面有fish和omf两个子目录)；
- 3、安装好之后，如果你用 `ls -l`之类的命令列出文件，在有些系统中排列会发生错乱，此时你只需要关闭终端当前tab，新开一个tab重新登录进去就好了；
- 4、安装好之后，会有一个 `omf`命令可以使用(`omf`直接查看帮助，不用 `-h`)，它用于管理一些主题和插件，类似zsh的 `omz`命令；
- 5、oh-my-fish的启动入口脚本为 `~/.config/fish/conf.d/omf.fish`；

### 多用户安装问题

对于桌面系统来说，无论是macOS还是Linux桌面系统(Ubuntu,archLinux等等)，一般桌面系统用户都是一个普通用户(比如我用鼠标新建一个文件夹，它会属于这个普通用户)，但是可以 `su -`或 `sudo -s`切换到root用户。

对于 `fish`这个命令来说，肯定是普通用户和超级用户都可以用的，但问题是配置文件，包括[oh-my-fish](https://github.com/oh-my-fish/oh-my-fish)它本质也属于配置文件，它们应该是普通用户和超级用户各配置一份吗？

**对于macOS**：其实不需要配置多份，只需要普通用户安装一份即可，切换到超级用户时，使用 `sudo -s`来切换，这样虽然切换到root了，但配置文件都会用普通用户的配置文件，所以根本无需设置两份配置，只需要普通用户一份配置文件即可。

**对于Linux桌面系统**：linux用 `sudo -s`(或 `su`/`su -`等)切换到root后不会使用普通用户的配置，这跟macOS不一样，我们可以把普通用户下的配置做一个符号链接到root用户下

```bash

ln -s /home/用户名/.local/share/fish /root/.local/share/fish

ln -s /home/用户名/.local/share/omf /root/.local/share/omf

ln -s /home/用户名/.config/fish /root/.config/fish

ln -s /home/用户名/.config/omf /root/.config/omf

```

**对于Linux服务器**：如果是个人使用的，可以跟桌面系统一样，做一个符号链接到 `/root/`下即可，但是如果是多人共用的，就看情况了，你也可以用创建符号链接的方式，把其中一个用户的配置链接到root用户，也可以重新安装配置，但我认为没有这个必要，一般来说，超级管理员把它自己的普通用户配置做个符号链接过去就可以了。当然会在服务器安装fish的，应该只有个人用户了，公司线上机器是不可能安装fish的。

## fish和oh-my-fish的使用

### 使用omf安装主题

显示有哪些主题可以安装([这里](https://github.com/oh-my-fish/oh-my-fish/blob/master/docs/Themes.md)可以预览主题样式)

```bash

omf theme

```

选择其中一个主题安装，安装后会存储在 `~/.local/share/omf/themes/`下

```bash

omf install bobthefish

```

可以看到我安装了agnoster和bobthefish两个主题，而default则是默认主题

```bash

> ls -l ~/.local/share/omf/themes/                                                                                                Sun Feb 19 14:41:39 2023

total 12

drwxr-xr-x 4 root root 4096 Feb 18 01:23 agnoster/

drwxr-xr-x 5 root root 4096 Feb 18 01:26 bobthefish/

drwxr-xr-x 4 root root 4096 Feb 18 00:53 default/

```

### 安装符号字体

安装好bobthefish主题后，输入 `sudo -s`并输入密码，切换到超级用户，然后进入以下文件夹

```bash

~/.local/share/omf/themes/bobthefish/functions

```

然后会看到以下效果

![](https://img.xiebruce.top/2023/02/27/8ffe93f823798a617b8d7ad5cfc0447c.jpg)

我们用鼠标划选，让它反显，显示如下，我们可以看到很多黑色的三角形

![](https://img.xiebruce.top/2023/02/27/54615d6f445d51edcd13ca895c0c8508.jpg)

其实在终端中其实是没有“三角形”这种形状的，你看到的“三角形”其实是“字”，还有②所示的那个“git分支”符号，也是“字”，只不过这些“字”并不是中文或英文或其它语言的字，而是一些“符号”，因为“字”本身也是一种符号，只不过我们把它叫成是“字”而已

![](https://img.xiebruce.top/2023/02/27/b43a2749030d03cdb5c3bf2ff6f96540.jpg)

由于这些“字”并不是普通的字，所以系统本身是不带这些字体的，所以如果你之前没有安装过这些字体，这些符号你是看不见的，应该会显示成一个“方框”之类的，表示无法显示，我这边能显示是因为我之前用的是zsh，zsh的主题也要用到这些字体，所以我已经安装过这些字体了，所以才不会显示为“方框”。

那么要安装什么字体呢？有两种字体库：

- 1、[Powerline fonts](https://github.com/powerline/fonts)
- 2、[nerd-fonts](https://github.com/ryanoasis/nerd-fonts)

你可以只安装其中一种，也可以两种安装，不过从github更新来看，[Powerline fonts](https://github.com/powerline/fonts)已经没怎么更新了，最新的一个更新已经是6年前(当前时间2023.02.27)，而[nerd-fonts](https://github.com/ryanoasis/nerd-fonts)最新的是2年前(文档、安装脚本之类的更新不算，我说的是真正的字体更新)。

以下是nerd-fonts的所有符号(引用自github)

![nerd-fonts](https://raw.githubusercontent.com/ryanoasis/nerd-fonts/5d57dbe9a06e1132363876b2e3e45224d54f7c8c/images/sankey-glyphs-combined-diagram.svg)

nerd有技术迷，电脑迷的意思，所以nerd-fonts意思就是给开发者使用的字体(这些字体都是一些开发者群体常用的一些符号)。

关于powerline字体在macOS/Linux的安装，之前zsh的文章已经讲过，请看：[四、配置powerline](https://www.xiebruce.top/590.html#powerline)。

而nerd-fonts我这边没有安装过，请直接看[nerd-fonts安装文档](https://github.com/ryanoasis/nerd-fonts#font-installation)。

### 修改fish/omf配置的方法

**修改配置无非是两种需求**：

- 1、主题(theme)的配置：包括配色、一些提示符号等等；
- 2、添加环境变量：有时候如果安装的软件不在标准可执行文件路径下，就需要手动把它们添加到环境变量中；

**fish/omf的配置主要有三种修改方法**：

- 1、一般情况下，配置都会放到 `~/.config/fish/config.fish`文件下，其作用相当于 `zsh`的 `.zshrc`和 `bash`的 `.bashrc`，config.fish如果不存在，你就手动创建一下(是否默认存在可能跟不同版本有关)；
- 2、一部分配置会放到 `~/.config/fish/fish_variables`文件中，但该文件不能直接编辑，而是需要通过 `set -U`来设置(U是Universal，表示全局)；
- 3、如果没有配置项，则需要直接修改源码，但是修改源码也不是直接修改，而是采用覆盖方式(把对应的functions目录中你需要修改的文件原样复制到 `~/.config/fish/functions/`然后在这里修改)；
- 4、`~/.config/fish/conf.d/`下的 `omf.fish`是omf的入口文件，其内容如下，其实说白了，就是 `~/.config/fish/`文件夹才是fish的配置文件夹，其它文件夹中的配置都是因为从这里引入了所以才能放在其它位置

  ```bash

  ```

# Path to Oh My Fish install.

set -q XDG_DATA_HOME

  and set -gx OMF_PATH "$XDG_DATA_HOME/omf"

  or set -gx OMF_PATH "$HOME/.local/share/omf"

# Load Oh My Fish configuration.

source$OMF_PATH/init.fish

    ```

如果config.fish默认是存在的，它的默认内容应该是这样的

```bash

if status is-interactive

# Commands to run in interactive sessions can go here

end

```

如果把配置放到if里面，表示在交互状态下配置才会生效，平时我们操作shell，都是属于交互状态，如果写成脚本执行就不属于交互。不过脚本执行的话，也与界面显示无关，所以一般不需要我们的自定义配置项，但环境变量的话就不应该写到if里面，因为有些环境变量在脚本形式也是需要读取的。

---

**如何让修改后的配置生效？**：

- 1、对于config.fish，与 `.bashrc`和 `.zshrc`一样，使用source加载即可：`source ~/.config/fish/config.fish`；
- 2、functions配置修改后会直接生效，不需要手动加载(但有时候也不是那么的“自动”，比如需要你执行一下 `clear`，按几下回车才会生效)；
- 3、通过 `set -U`设置的，会直接生效，同时也会保存到 `~/.config/fish/fish_variables`，以持久化该设置；
- 3、个别配置既不会自动生效，用source也无法生效，那就关掉终端重新登录即可；
- 4、由于我们的配置项只放在config.fish和fish_variables中，如果你发现某个配置明明删掉了还是存在，请检查fish_variables，大概率是在该文件下没删掉，因为fish_variables是命令设置进去的，有时候并不是那么的“可读”(比如横杠会被显示成 `\x2d`，等号会显示成 `\x3d`)。

### 让vim支持fish语法高亮显示

前面已经讲了如何修改配置，接着我们就来修改配置，个性化定制主题，不过在修改配置之前，先配置一下让vim支持fish文件语法高亮，否则修改配置的时候一片灰色，很难看。

---

创建 `~/.vim/`目录，如果已经有了，可以忽略这一步

```bash

mkdir -p ~/.vim

```

把[vim-fish](https://github.com/dag/vim-fish)下载到 `~/.vim`目录下

```bash

git clone https://github.com/dag/vim-fish ~/.vim/vim-fish

```

在 `~/.vimrc`文件中添加以下这句即可

```bash

set rtp+=~/.vim/vim-fish

```

当然如果你安装了插件管理器，那就使用插件管理器来安装，或者手动把它下载到插件管理器要求你放置的地方就好了，比如我安装了[pathogen](https://www.xiebruce.top/865.html)插件管理器，我就只需要把它克隆到 `~/.vim/bundle/`下，并且也不需要在 `~/.vimrc`中添加rtp了，因为插件管理器会自动加载。

关于vim插件的管理以及配置文件的存放位置等等，可查看：[vim配置文件结构](https://www.xiebruce.top/1840.html)。

### 修改bobthefish主题的配置

[bobthefish](https://github.com/oh-my-fish/theme-bobthefish)是一个主题插件，由于它有非常多的配置项，方便各种自定义配置，所以我安装了该主题，如果你喜欢其它主题，也可以安装你喜欢的，一般主题都是开源在github上，它有自己的配置文档。以下是[bobthefish](https://github.com/oh-my-fish/theme-bobthefish)主题的配置过程。

[bobthefish](https://github.com/oh-my-fish/theme-bobthefish)主题默认是这样的

![](https://img.xiebruce.top/2023/02/27/ffba76427e78dfc11526a0ba99ea8e88.jpg)

**目前有3个问题**：

- ① 当你进入多级目录后，它会把除末级外的其它全部只显示成一个字母，而我希望它显示完整路径；
- ② `whoami`显示当前为root用户，然而前面的 `$`让我觉得当前是普通用户(因为Linux下普通用户都是用 `$`表示)；
- ③ 没有当前用户名和主机名显示，比如 `root@debian`。

通过查bobthefish主题的readme.md的[configuration](https://github.com/oh-my-fish/theme-bobthefish#configuration)可知，问题①可通过在 `config.fish`中添加以下设置项来关闭这种显示单个字母的模式

```bash

# 0表示关闭，1,2,3,……分别表示只显示1个,2个,3个,……字母

set -g fish_prompt_pwd_dir_length 0

```

问题③可通过在 `config.fish`中添加以下设置项来解决

```bash

set -g theme_display_user yes

set -g theme_display_hostname yes

```

而问题②经过查文档发现并没有配置项可以设置，那我们只能修改源码了，根据前面[使用omf安装主题](https://www.xiebruce.top/1841.html#omf)可知，该主题被安装到了以下目录

```bash

~/.local/share/omf/themes/bobthefish/

```

查看该目录发现它只有两个文件夹，可知它的代码都是写在“functions”目录下的(其实fish插件都是通过写functions来实现的)

```bash

> ls -l ~/.local/share/omf/themes/bobthefish/                                                                          Sun Feb 19 16:07:22 2023

total 28

-rw-r--r-- 1 root root  1086 Feb 18 01:26 LICENSE

-rw-r--r-- 1 root root 14325 Feb 18 01:26 README.md

drwxr-xr-x 2 root root  4096 Feb 19 13:43 functions/

drwxr-xr-x 2 root root  4096 Feb 18 12:24 hooks/

```

查看functions目录，由于我们不知道前面问题②那个 `$`符号在哪里设置的，所以只能一个一个文件找(其实也可以通过vscode打开这个文件夹，然后全文查找 `$`符，这样更容易找到)

```bash

ls -l ~/.local/share/omf/themes/bobthefish/functions/                                                                Sun Feb 19 16:09:12 2023

total 108

-rw-r--r-- 1 root root 34289 Feb 18 01:26 __bobthefish_colors.fish

-rw-r--r-- 1 root root   127 Feb 18 01:26 __bobthefish_display_colors.fish

-rw-r--r-- 1 root root  3362 Feb 18 01:26 __bobthefish_glyphs.fish

-rw-r--r-- 1 root root  4264 Feb 18 01:26 bobthefish_display_colors.fish

-rw-r--r-- 1 root root   266 Feb 18 01:26 fish_greeting.fish

-rw-r--r-- 1 root root  1186 Feb 18 01:26 fish_mode_prompt.fish

-rw-r--r-- 1 root root 37193 Feb 18 01:26 fish_prompt.fish

-rw-r--r-- 1 root root  2492 Feb 18 01:26 fish_right_prompt.fish

-rw-r--r-- 1 root root   968 Feb 18 01:26 fish_title.fish

```

最终我们找到是在 `__bobthefish_glyphs.fish`文件中的 `superscript_glyph`设置项

![](https://img.xiebruce.top/2023/02/27/824f26a1b143f9ec37546dac9eef014c.jpg)

直接修改它当然是可以，但是下次插件更新又会被覆盖，正确方式是把 `__bobthefish_glyphs.fish`文件copy一份到用户自己的functions配置目录下

```bash

cd ~/.local/share/omf/themes/bobthefish/functions/

cp __bobthefish_glyphs.fish ~/.config/fish/functions/

```

然后修改 `~/.config/fish/functions/`下的 `__bobthefish_glyphs.fish`文件中的选项，保存直接生效(如果不生效可能执行个 `clear`再敲几个回车就生效了)，如下图所示，我是把它改成了“⚡️”

![](https://img.xiebruce.top/2023/02/27/7b1c7318172055af96ccf34e33c7bef9.jpg)

**注意**：如果你是通过macOS的 `control+optoin+空格`添加的“⚡️”符号，它会带有一个未知字符(会被显示为空格)，记得回删一下，否则会导致在超级用户下路径箭头右侧多一个空格，因为本来就有一个空格，多一个空格就是两个空格，这样看起来很难受。

通过以上设置，现在问题①②③都解决了，路径显示全名了，“用户名@主机名”也有了，前面的符号也变成我喜欢的⚡️了

![](https://img.xiebruce.top/2023/02/27/a42f3491652a247da29e98833a106148.jpg)

通过以上设置，我们知道了，修改配置，要不就找插件自己提供的设置项放到 `~/.config/fish/config.fish`文件中，要不就是通过修改插件源码(function文件)的方式，但修改源码我们不是直接在原地修改，而是复制一份到 `~/.config/fish/functions/`目录下再修改。同理，其它插件需要修改配置项，都是采用这种模式。

---

**特别注意**：通过source加载配置后，你无法通过“注释并再次source”来取消该配置，什么意思呢？

比如你用以下设置显示当前路径命名，source一下生效了，显示命名了

```bash

set -g fish_prompt_pwd_dir_length 0

```

此时你再把它注释掉，再souce，由于你已经设置过了，就算你注释掉这个选项，该设置还是会存在的，当然是仅存在于当前终端tab中，所以你新开一个终端tab再次登录才能看到效果

```bash

# set -g fish_prompt_pwd_dir_length 0

```

又或者你不要取消注释，而是直接设置回它的默认值，即

```bash

set -g fish_prompt_pwd_dir_length 1

```

source一下就能生效，也就是回到之前的只显示一个字母的形式。

### 修改bobthefish主题配色

根据bobthefish主题的文档：[Custom color schemes](https://github.com/oh-my-fish/theme-bobthefish/wiki/Custom-color-schemes)，我们需要在自定义函数文件夹 `~/.config/fish/functions/`创建一个函数文件 `bobthefish_colors.fish`

```bash

touch ~/.config/fish/functions/bobthefish_colors.fish

```

然后把以下函数放进文件中，然后修改该文件即可(该函数是我已经调过色的了)

```bash

functionbobthefish_colors -S -d 'Define a custom bobthefish color scheme'


# Optionally include a base color scheme

  __bobthefish_colors default


# Then override everything you want!

# Note that these must be defined with `set -x`

#-----------

set -x color_initial_segment_exit     black red --bold

set -x color_initial_segment_su       black green --bold

set -x color_initial_segment_jobs     black green --bold


set -x color_path                     1EB0FC black

set -x color_path_basename            1EB0FC black

set -x color_path_nowrite             1EB0FC black

set -x color_path_nowrite_basename    1EB0FC black

#------


set -x color_repo                     green black

set -x color_repo_work_tree           black black --bold

set -x color_repo_dirty               brred black

set -x color_repo_staged              yellow black


set -x color_vi_mode_default          brblue black --bold

set -x color_vi_mode_insert           brgreen black --bold

set -x color_vi_mode_visual           bryellow black --bold


set -x color_vagrant                  brcyan black

set -x color_k8s                      magenta white --bold


if fish_is_root_user

set -x color_username                 0A5F5F yellow

set -x color_hostname                 0A5F5F yellow

else

set -x color_username                 0A5F5F white

set -x color_hostname                 0A5F5F white

  end



set -x color_rvm                      brmagenta black --bold

set -x color_virtualfish              brblue black --bold

set -x color_virtualgo                brblue black --bold

set -x color_desk                     brblue black --bold

end

```

不同变量代表不同区域的颜色，以下面一句为例

```bash

set -x color_initial_segment_exit     black red --bold

```

-`set -x`表示设置变量，`-x`表示exported，即导出变量，导出的变量才会被放到环境变量中(即 `env`或 `export`命令输出的环境变量)；

-`color_initial_segment_exit`表示要设置颜色的区域(下面会详细说明是哪个区域)；

-`black red --bold`三个参数依次表示：背景色、前景色(即文字颜色)、文字是否加粗(如果不加粗可以不用第三个参数)；

- 颜色可以用英文也可以用十六进制(但开头不能带 `#`号)，十六进制色码对应什么颜色，可以去[这里](https://eng.m.fontke.com/tool/rgb/)查询，或者去[颜色对照表](https://www.xiebruce.top/colors.html)中查找。

---

以下详细说明颜色区域对应的变量，注意每段区域的结尾都是那个尖角，所以下图包含三段大区域，分别为①红色区域、③黄色区域、⑤浅蓝色区域，只不过每个区域内部又可以有更详细的设置

![](https://img.xiebruce.top/2023/02/27/50808b5efa829b32fe6639675bfd553f.jpg)

- ① color_initial_segment_exit：initial_segment表示起始区域，图中的颜色为 `red white --bold`，其中“感叹号”表示 `exit`(退出的意思，比如末尾加 `&`运行的后台任务运行完之后退出，或者输入不存在的命令按回车也表示退出)；
- ② color_initial_segment_su：su是superuser(超级用户)，即该选项用于设置在超级用户下显示的符号、颜色和底色，图中的颜色为 `blue green --bold`，如果符号是emoji，则第二个参数(green)无效；
- ③ color_username，理论上包含当前用户名+主机名整段颜色，图中颜色为 `yellow black`，实际上由于主机名的颜色另有变量，所以主机名部分的颜色会被另一个变量覆盖；
- ④ color_hostname，主机名颜色，图中颜色为 `blue white`；
- ⑤ color_path，当前路径颜色，图中配色为 `1EB0FC black`(其中1EB0FC为天蓝色)；
- ⑥ color_path_basename，指当前路径中最后一级的颜色，上图中就是指 `etc`这一级，图中颜色为 `yellow black`；

**注**：fish中支持一种br开头的颜色，比如red是红色，brred就是亮(鲜)红色，brgreen鲜绿色，(br我猜是bright的意思)，是否支持加br，都可以自己在原有颜色英文前面加一下试试看。

---

**测试后台任务符号颜色**：创建一个sh文件+赋予可执行权限+后台执行(即末尾加 `&`)，可以发现它会出现下图的百分号 `%`，这个百分号的颜色和背景色，是用 `color_initial_segment_jobs`变量来设置的(后台任务英文就叫“jobs”)

```bash

echo'#!/usr/bin/env fish' > job.sh && chmod u+x job.sh && ./job.sh &

```

![](https://img.xiebruce.top/2023/02/27/ab819455401bce07ee0f0cbd24b37781.jpg)

---

当前用户对当前文件夹无写入权限时，显示的颜色(深紫)

```bash

set -x color_path_nowrite             BF00BF white

set -x color_path_nowrite_basename    BF00BF white

```

![](https://img.xiebruce.top/2023/02/27/98557eaf77055e1bd5fdf0a1e2d4a91f.jpg)

以下是我的 `bobthefish_colors.fish`中修改过的配置项(对应路径从左到右)

```bash

# 退出符号(敲不存在的命令按回车就会有)

set -x color_initial_segment_exit     black red --bold

# 超级用户符号的颜色(在最左侧)

set -x color_initial_segment_su       black green --bold

# 后台任务的符号

set -x color_initial_segment_jobs     black green --bold

# 如果是超级用户

if fish_is_root_user

# 用户名颜色

set -x color_username                 0A5F5F yellow

# 主机名颜色

set -x color_hostname                 0A5F5F yellow

else

# 用户名颜色

set -x color_username                 0A5F5F white

# 主机名颜色

set -x color_hostname                 0A5F5F white

end

# 整个路径的颜色

set -x color_path                     1EB0FC black

# 最后一级路径的颜色

set -x color_path_basename            1EB0FC black

# 无写入权限路径的颜色

set -x color_path_nowrite             1EB0FC black

# 无写入权限路径最后一级的颜色

set -x color_path_nowrite_basename    1EB0FC black

```

这是最终显示效果

![](https://img.xiebruce.top/2023/02/27/2c4015f7ccf84af960cfb83721487c46.jpg)

### 通过fish_config修改命令颜色

无论是zsh还是fish，都有以颜色来提示命令是否存在的功能：就是你输入一个命令，如果该命令存在，它会显示一种颜色，如果不存在，它会显示另一种颜色(通常是红色)。

在终端执行 `fish_config`命令，会输出以下提示，它一般会自动打开第一个文件，但是第一个文件一般是无法打开的，所以我们要自己点击第二个地址就可以在网页上打开(此时它是挂起状态，相当于开启一个web服务器，如果要结束可以按回车)

![](https://img.xiebruce.top/2023/02/27/201b5b94a220768987c3221f7e5c55c8.jpg)

打开后如下图所示，①点击右侧的“Customize”→②选中你要设置颜色的部分→③选择颜色→④点击“Set Theme”保存

![](https://img.xiebruce.top/2023/02/27/7ccc71625dc1c171b06cd98ac7cefef5.jpg)

点“Set Theme”后它会在fish_config挂起的界面输出设置项，这些设置项都是加了 `-U`选项的，`-U`表示universal，有了 `-U`的选项都会被自动保存到 `~/.config/fish/fish_variables`文件中(所以 `fish_variables`文件是不能手动编辑的，它是fish用于自动保存变量用的)，而 `-g`(global)虽然指全局变量，但这个全局只会在当前窗口中，不会被保存，`-g`这个“全局”只是相对于函数内部的局部变量来说是全局变量而已。

通过web页面修改的颜色，本质上还是通过set改变某些变量的值来设置，所以如果有些你不喜欢，你还是可以通过 `set`命令来设置，而且实际上有些部分的配色是无法通过web页面修改的。

至于配置要放在哪里，前面[修改fish/omf配置的方法](https://www.xiebruce.top/1841.html#fishomf)说过，保存配置的有两个文件：`~/.config/fish/config.fish`和 `~/.config/fish/fish_variables`，前者是直接在文件中修改，后面不能直接在文件中修改，而是需要通过 `set -U`来设置对应变量。

---

如果是服务器，它无法打开web页面，直接在终端中执行以下配置即可(它会保存到 `~/.config/fish/fish_variables`文件中)

```bash

set -U fish_color_autosuggestion afafaf

set -U fish_color_cancel --reverse

set -U fish_color_command 00ff00

set -U fish_color_comment FF9640

set -U fish_color_cwd green

set -U fish_color_cwd_root red

set -U fish_color_end FFB273

set -U fish_color_error FF7400

set -U fish_color_escape 00a6b2

set -U fish_color_history_current --bold

set -U fish_color_host normal

set -U fish_color_match --background=brblue

set -U fish_color_normal normal

set -U fish_color_operator 00a6b2

set -U fish_color_param 33CCCC

set -U fish_color_quote 5CCCCC

set -U fish_color_redirection BF7130

set -U fish_color_search_match bryellow --background=brblack

set -U fish_color_selection white --bold --background=brblack

set -U fish_color_status red

set -U fish_color_user brgreen

set -U fish_color_valid_path --underline

```

### 设置Tab自动完成颜色

本部分内容文档为：[Pager color variables](https://fishshell.com/docs/current/interactive.html#pager-color-variables)。

首先，我有一个images文件夹，里面有非常多图片，然后我输入 `ls -l images`，按一下tab键，就会出来 `images/`文件夹下的所有图片(本质上应该说是文件和文件夹)，继续按tab(或用方向键)，光标会自动在文件列表中选择(如下图所示)

![](https://img.xiebruce.top/2023/02/27/703f43bca2fffa00fdd409b6ef947b18.jpg)

在 `~/.config/fish/config.fish`中使用以下配置可以调出上图颜色，如果你不喜欢，可以修改对应的颜色(可以用十六进制但最好不要用#号，因为#号是注释符号，容易造成错误)

```bash

# 控制上图白色部分的颜色

set -g fish_pager_color_prefix white --bold

# 控制上图白色部分被选中后会变成什么颜色

set -g fish_pager_color_selected_prefix green


# 控制上图黄色部分颜色(默认为normal)

set -g fish_pager_color_completion yellow

# 控制上图中黄色部分被选中后会变成什么颜色

set -g fish_pager_color_selected_completion white


# 控制上图中光标未选中部分的背景颜色(其实就是列表背景，因为被选中的只会有一个)

set -g fish_pager_color_background --background=black

# 控制上图中光标选中部分的背景颜色

set -g fish_pager_color_selected_background --background=brred


# 选项提示颜色(输入“ls -”后按tab，会列出ls有哪个“-”开头的参数)

set -g fish_pager_color_description yellow

# 选项提示被选中后的颜色

set -g fish_pager_color_selected_description black


# 含secondary的有四个，其实就是前面的四个加了secondary,它们的意思，其实跟不加secondary是一样的

# 只不过加了secondary只会作用于偶数行(因为secondary是“第二位的”，在这里理解为偶数)

set -g fish_pager_color_secondary_prefix

set -g fish_pager_color_secondary_completion

set -g fish_pager_color_secondary_background --background=646464

set -g fish_pager_color_secondary_description


# 左下角翻页进度文字颜色+背景色(#21C5C6)，文件多才会出现

set -g fish_pager_color_progress FFFFFF --background=21C5C6

```

输入“ls -”后按tab，会列出ls有哪个“-”开头的参数以及参数的解释

![](https://img.xiebruce.top/2023/02/27/10384445599c3b2902235f0f6fdea157.jpg)

**特别注意！！！**

**特别注意！！！**

**特别注意！！！**

如果 `~/.config/fish/fish_variables`中已存在某个选项(假设为 `fish_pager_color_completion`)，那么以下两句的作用是有区别的

```bash

# 没有参数，会直接修改fish_variables中该选项的值

set fish_pager_color_completion green


# 带有-g，不修改fish_variables中的值，而是覆盖它的值

set -g fish_pager_color_completion green

```

所以如果fish_variables中真的有该选项，而你又刚好用了set没加 `-g`，结果就是你即使把你自己的设置删掉，或者重启终端，之前没加 `-g`的那个设置还会存在，就有种“怎么都无法清除”的感觉，如果出现这种情况，记得去fish_variables文件中找，一定找的到那个选项，也可以直接输入 `set`回车，这样可以输出全部set的变量，包括fish_variables中的也会被输出。

### export/env/set/declare的区别

**export**：

export这个单词的意思是“导出”，它有两个用法：

- 1、定义导出变量：执行 `export aaa=111`，定义了一个aaa变量，可用 `echo $aaa`打印它的值；
- 2、查看导出变量：直接执行 `export`即可输出当前导出的变量(即环境变量)；

---

**env**：

env是environment的缩写，意思就是环境变量，它有三种用法：

- 1、执行程序：执行 `env bash`，可把当前环境变量带给后面的bash(bash可以换成其它程序)，如果带上参数，根据参数的不同，可提供你所需要的环境变量给后面的程序；
- 2、我们经常使用 `#!/usr/bin/env bash`、`#!/usr/bin/env python`用于指定脚本的执行程序，比起直接指定bash或python路径，使用env可避免在不同环境中路径不一致时无法执行的问题；
- 2、查看环境变量：直接执行 `env`，用于输出当前的环境变量，`env`的输出结果和 `export`的输出结果是一样的，都表示当前的环境变量(不过顺序会有不同)；

**注**：其实前两种用法属于同一种用法，只是用在不同的地方而已。

---

**declare**：

在bash中用于定义变量，比如 `declare bb=22`，然后用 `echo $bb`即可打印出来，但是这样设置的变量不是导出变量(即不是环境变量)，执行 `export`(或 `env`)的输出结果，是不会有 `aa`这个变量存在的。

如果想要把定义的变量设置为导出变量，可以加个 `-x`，即 `declare -x cc=33`，这样用 `export`或 `env`都能打印出 `cc`变量。在bash中，export设置变量，它其实是会调用 `declare -x`来设置的。

**注意**：fish中不存在declare关键字，改为用 `set`代替。

---

**set**：

set在bash只用于设置局部变量，它设置的变量无法用 `echo`打印出来，也不会存在于环境变量中，但在fish中，set代替了 `declare`(只不过名称和值之间用空格，而不用等号)，fish中没有declare，即你可以用 `set dd 33`来设置一个非导出变量(不会存在于环境变量中)，也可以用 `set -x ee 44`来设置一个导出变量，它会存在于环境变量中(`env`或 `export`的输出结果能看到它)。

---

**注意**：从以上可知，设置一个环境变量可用 `export`和 `declare`(或 `set`)，但它们设置的值都仅存在于当前终端窗口中，你新开一个Tab标签或新开一个窗口，它们是不会存在的。

如果想要它们在任何窗口中都存在，需要在每个窗口中都重复设置一遍，但是这样太麻烦了，所以我们可以把它们加入到配置文件中，由于每打开一个终端窗口，配置文件都会被执行一次，所以你定义的变量自然就会被加入到该窗口所在的环境变量中。

对于bash，可把设置语句加入到 `~/.bashrc`文件中，对于zsh，可以把设置语句加入到 `~/.zshrc`文件中，对于fish，可把配置文件加入到 `~/.config/fish/config.fish`中，当然修改后，要记得使用 `source`命令加载一下，否则是不会马上在当前窗口生效的，除非你新开一个窗口。

---

**总结**：export/declare/set都可以用于定义环境变量，bash中export定义变量是调用 `declare -x`来定义的，fish中没有declare，改为使用 `set`代替，fish中 `set -gx`定义的变量与 `export`定义的变量一样，都会被放入环境变量中。

### 在fish中添加环境变量

文档：[path variables](https://fishshell.com/docs/current/language.html#path-variables)。

fish的环境变量可以用 `export`和 `set`的方式添加，在 `~/.config/fish/config.fish`中添加以下两个环境变量

```bash

# 使用export设置一个环境变量

export aa=1


# 使用set命令设置一个变量，与export不同的是，它使用空格而不使用等号

set -gx bb 2

```

**注**：`-g`表示global，`-x`表示export，如果不用 `-x`，设置的变量就不会被放到环境变量中。

source加载一下刚刚的配置

```bash

source ~/.config/fish/config.fish

```

输出两个环境变量的值，输出 `1 2`，这是正常的，都明两种方式都可以

```bash

echo$aa$bb

```

在 `export`或 `env`或 `set`的输出结果中，都能找到前面设置 `aa`和 `bb`变量

```bash

export | grep aa

export | grep bb


env | grep aa

env | grep bb


set | grep aa

set | grep bb

```

---

向 `$PATH`添加路径(在 `~/.config/fish/config.fish`文件中添加)

```bash

# 方式一：使用"set -gx"定义

set -gx PATH "$PATH:/usr/local/bin"


# 方式二：使用export

export PATH="$PATH:/usr/local/bin"

```

输出 `$PATH`看看当前环境变量，这样看是没有冒号(`:`)分隔的

```bash

> echo$PATH

/usr/local/sbin /usr/local/bin /usr/sbin /usr/bin /sbin /bin

```

如果你想要输出有冒号分隔的格式，可以用以下命令

```bash

env | grep PATH

```

---

另一种添加变量的方法，是使用 `fish_add_path`命令来添加，如下所示(其它参数看[这里](https://fishshell.com/docs/current/cmds/fish_add_path.html#example))

```bash

fish_add_path /opt/mycoolthing/bin

```

上述添加PATH环境变量命令会向 `~/.config/fish/fish_variables`文件中添加一条命令，如下所示

```bash

SETUVAR fish_user_paths:/usr/local/bin

```

fish_variables用于存放fish的环境变量，该文件不能直接编辑，因为它是存放你用命令添加的数据的，就算你编辑了也会在你下次用命令修改变量时被覆盖的。

### 比alias更好用的abbr

我们知道，在bash和zsh中，有 `alias`命令，可以把一些长命令设置为短命令，比如 `alias ll="ls -l"`，就可以用 `ll`代替"ls -l"，对于频繁使用的命令来说，用alias定义一个短名简化命令，敲起来更方便。

而abbr是abbreviation的缩写，该单词的意思就是“缩写”，它的功能其实跟 `alias`差不多，不过又有所区别，当然fish也是可以使用 `alias`的，只不过它又多了一种 `abbr`而已。

在 `~/.config/fish/config.fish`中添加以下命令

```bash

# 用gco代替git checkout

abbr --add gco git checkout


# 用ll代替ls -l

abbr --add ll ls -l

```

加载一下，让前面添加的配置生效

```bash

source ~/.config/fish/config.fish

```

**测试**：输入 `gco`(或 `ll`)，按一下空格(或回车)，它会自动把命令展开为 `git checkout`(或 `ls -l`)，这与alias方式不一样，这样的好处是既可以以缩略形式输入，又能展开原形式，让你或别人不至于不知道你敲的是啥命令(因为你可能写博客文章要放截图、github提issue要放截图、或录视频教程)。

---

其它abbr的相关参数

```bash

# 删除，可删除多个

abbr --erase <abbr1> <abbr2> 


# 重命名

abbr --rename OLD_WORD NEW_WORD


# 显示你已经定义过的abbr

abbr -l


# 以详细形式显示你已经定义过的abbr(输出的命令可直接用于执行)

abbr --show

```

其实删除的话，我觉得没啥必要，因为如果你要删除，直接注释或去掉配置文件中相关配置就好了，当然需要新开窗口才能生效(source是不会生效的，因为它已经在当前session中了)，如果要立刻生效，还是得用 `--erase`选项

### 让fish支持autojump

安装autojump

```bash

# macOS

brew install autojump

# centos

sudo yum -y install autojump

# debian

sudo apt-get install autojump

```

**在config.fish中引入autojump.fish**：请在 `~/.config/fish/config.fish`中添加下面这句

```bash

# macOS

. /usr/local/share/autojump/autojump.fish


# Linux

. /usr/share/autojump/autojump.fish

```

然后source加载一下让前面添加的配置生效

```bash

source ~/.config/fish/config.fish

```

然后就有 `j`命令可以用了，至于autojump的具体用法，我之前在介绍zsh的时候已经讲过，这里就不重复讲，请直接去看我的zsh文章：[autojump基本用法](https://www.xiebruce.top/590.html#autojump-2)。

### 修改ls输出的目录颜色

ls输出目录要有彩色，必须满足两个条件：

- 1、定义了彩色环境变量：LS_COLORS(Linux),LSCOLORS(macOS)；
- 2、打开了ls的彩色输出开关：Linux可通过添加 `--color=auto`(auto也可以为yes,tty,aways等等)选项，而macOS有两个打开彩色输出的开关：设置 `CLICOLOR=1`或添加 `-G`选项。

如果未定义彩色环境变量，但是打开了ls的彩色输出开关，那么它会输出系统默认的“彩色”(这种颜色一般是深蓝色，如下图，根本看不清)

![](https://img.xiebruce.top/2023/02/27/80df11f16b57bf07e46551f32fad818d.jpg)

以下我会从bash说起，然后再说到fish，原因下边会讲。

---

**Linux**：

对于Linux(我这边是Debian11)，看下图应该就能明白了(下图使用的shell为bash，不是fish)

![](https://img.xiebruce.top/2023/02/27/360817ed97653de1accde3ede8f1e7c6.jpg)

- ① 直接用 `ls`，理论上来说我没有用 `--color=auto`打开彩色输出开关它不应该输出彩色的，但事实上却输出了，原因往下看；
- ② 用 `/bin/ls`，这次没有彩色了，这是正常的；
- ③ 用 `/bin/ls`并且添加了 `--color=auto`，输出了彩色，这是正常的，因为 `--color=auto`就是用于打开彩色输出开关的；
- ④ 由于前面 `ls`和 `/bin/ls`结果不一样，所以我们怀疑 `ls`被设置了别名(即alias)，用 `alias ls`查看，果然是设置了 `alias ls='ls --color=auto'`；
- ⑤ 查看 `~/.bashrc`中是否有关于 `ls`的alias，果然找到了有这个定义，如⑥所示。

当然 `echo $LS_COLORS`还能看到该变量是有值的，这些值就是用于设置彩色显示时具体显示什么颜色，至于具体怎么设置，可以用 `man DIR_COLORS`查看使用手册，它一般是通过创建 `/etc/DIR_COLORS`文件并在该文件中设置的

![](https://img.xiebruce.top/2023/02/27/64ee8e4c3bec61657045ae8a9c583c3c.jpg)

---

**macOS在bash下**：

如下图所示

![](https://img.xiebruce.top/2023/02/27/a2b11b16941e87ba600ba55e95de8d2c.jpg)

- ① 直接用ls，不显示颜色，这是正常的，因为没有打开彩色显示开关；
- ② 添加 `-G`，打开了彩色显示，有颜色了，只不过颜色是默认的颜色(深蓝色)，所以看不清(但它总归是显示了颜色)；
- ③ 使用 `export CLICOLOR=1`向环境变量中添加 `CLICOLOR=1`；
- ④ 确认 `CLICOLOR=1`环境变量添加成功；
- ⑤ 再次使用ls，不用 `-G`也能输出彩色。

**自定义彩色**：以上虽然输出了彩色，但由于是默认的颜色，很难看，所以我们希望自己定义，执行 `man ls`并搜索“LSCOLORS”，可以找到相关的定义，我这里直接给出有一种不错的颜色。

在 `~/.bashrc`中添加以下环境变量，`source ~/.bashrc`让它生效，即可看到好看的颜色

```bash

export LSCOLORS=GxFxCxDxBxegedabagaced

```

如下图所示，这个目录的颜色就清晰多了

![](https://img.xiebruce.top/2023/02/27/987a4b01e983676c84fbf033b8aae953.jpg)

---

**macOS在fish下**：如下图所示

![](https://img.xiebruce.top/2023/02/27/f3baf2e3842f3a643a83c75ba89fbbda.jpg)

- ① 可以看到，ls不加 `-G`，就已经有彩色显示了；
- ② 用 `/bin/ls`却没有颜色，由此可知直接敲的 `ls`与 `/bin/ls`并非同一个；
- ③ 用 `/bin/ls`添加了 `-G`选项，有颜色，这是正常的，因为 `-G`是开启彩色显示的；
- ④ 用 `export CLICOLOR=1`定义环境变量 `CLICOLOR`为1；
- ⑤ 这次用 `/bin/ls`不加 `-G`也有颜色了，因为前面定义了 `CLICOLOR`为1；
- ⑥ 我们用fish的 `functions`命令查看 `ls`，发现它重新定义了一个ls函数，并且还给出了该函数的路径，所以我们直接执行ls，其实是用的fish的ls，而不是系统的ls；

在上边第⑥步输出的函数的末尾，其实是可以看到有 `set -lx CLICOLOR 1`这句的(我就不截图了，自己执行 `functions ls`命令就能看到)，这句就是用于设置 `CLICOLOR`环境变量为1，所以这就是为什么直接用 `ls`时它会显示彩色的原因。

---

**自定义ls函数**：自定义一个ls函数，覆盖fish自带的ls函数。

复制以下我们自定义的 `ls`函数代码到终端中(处于fish下)，然后按回车，就能覆盖fish自带的ls(当然它只会作用于当前终端，不会永久覆盖)

```bash

functionls

command ls $argv

end

```

如下图所示

![](https://img.xiebruce.top/2023/02/27/f42c1822730daf6607369b5021bc36aa.jpg)

- ① 查看 `CLICOLOR`环境变量，发现它没有值；
- ② 即使 `CLICOLOR`环境变量没有值，并且没有加 `-G`，但是默认也有颜色，原因在前面第⑥步下面已经说过；
- ③ 我们运行一下自定义的ls函数，它会覆盖fish自带的ls；
- ④ 再次运行 `ls`，发现目录已经没有颜色了，这次就对了。

现在已经知道fish默认就会显示彩色(因为fish的ls函数中默认设置了 `CLICOLOR=1`)，但是默认的颜色很难看，前面说bash的时候我们已经说过，我们可以自定义这个颜色，在 `~/.config/fish/config.fish`中添加 `LSCOLORS`环境变量为以下值

```bash

# 可以这样设置(bash,zsh,fish都可以)

export LSCOLORS=gxfxbEaEBxxEhEhBaDaCaD


# fish也可以这样设置(在config.fish中添加)，一定要用-x，-x表示export，如果不用，是无法被导出到环境变量中的

set -gx LSCOLORS gxfxbEaEBxxEhEhBaDaCaD

```

**特别注意**：前面说了 `CLICOLOR=1`可以开启ls彩色显示目录，但实际上我发现它根本不看这个值，只看它是否存在，什么意思呢？就是当我们自定义ls函数执行后，本来ls不会显示彩色目录了，但是如果此时你设置一个 `export CLICOLOR=0`或 `export CLICOLOR=false`，再执行ls，你会发现它又显示彩色目录了，也就是说，只要 `CLICOLOR`存在，无论它是空，是0还是false，都会被认为已开启ls的彩色显示目录开关。

### fish自定义function

前面我们在终端中(fish环境下)执行过一个自定义的ls函数(如下所示)，而且我也说了它只能作用于执行它的那个终端窗口(新开一个窗口它是不会起作用的)

```bash

functionls

command ls $argv

end

```

如果要使该函数持久起作用，需要保存它，执行 `funcsave ls`即可保存，它会提示保存路径，其实就是在 `~/.config/fish/functions/`下，当然你也可以直接去 `~/.config/fish/functions/`下创建 `ls.fish`文件，它都是直接生效的，不需要source之类的。

**查看函数及其路径**：fish都是一个函数一个文件，通过 `functions ls`能输出整个 `ls`函数以及它的路径，通过这种方法，你可以查看任意一个fish内置函数的路径，当你需要对内置函数进行覆盖修改时，你可以用这种方法输出它的路径，然后拷贝到 `~/.config/fish/functions/`下进行修改。

---

参考：

[Interactive use](https://fishshell.com/docs/current/interactive.html#interactive-use)

[How to enable colorized output for ls command in macOS X Terminal](https://www.cyberciti.biz/faq/apple-mac-osx-terminal-color-ls-output-option/)
