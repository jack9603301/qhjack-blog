---
title: 在gentoo安装和配置fish
tags:
  - linux
categories: linux
comments: true
copyright_reprint: false
description: 在这篇文章我们将在gentoo上安装fish，一个非常有意思的shell
abbrlink: 3509177094
date: 2022-11-29 14:40:16
---

最近，我关注到了一个非常有意思的shell，它具有完善的功能、好看的界面以及具有模块化的目录结构和布局，现在，我将安装它。

**我使用Gentoo**

# 准备环境

在Gentoo，我们可以使用以下命令来安装fish：
```bash
sudo emerge --ask fish
curl https://raw.githubusercontent.com/oh-my-fish/oh-my-fish/master/bin/install | fish
sudo chsh --shell /bin/fish <username>
```

# 安装并配置主题

我打算安装`bobthefish`，这是一个powerline风格的主题，具有高度的定制性，它的github页面是这样的：

{% asset_img bobthefish.png bobthefish主题 %}

我们执行以下命令配置`oh-my-fish`:

```fish
omf install bobthefish
```

当然，我们还需要配置一下其他的设置，关于`bobthefish`，我们可以从[官网](https://github.com/oh-my-fish/theme-bobthefish)找到所有详细的配置。而fish其他的配色，我们可以执行以下命令：

```fish
fish_config
```

界面如下：

{% asset_img web_config.png web_config %}

我们选择需要的配色方案，然后按下**Set Theme**
会看到如下输出：

```fish
# Colorscheme: Current
$ set -U fish_color_normal normal
$ set -U fish_color_command 00BF32
$ set -U fish_color_quote 206676
$ set -U fish_color_redirection 7CB02C
$ set -U fish_color_end 8EEB00
$ set -U fish_color_error 60B9CE
$ set -U fish_color_param 04819E
$ set -U fish_color_comment 5C9900
$ set -U fish_color_match --background=brblue
$ set -U fish_color_selection white --bold --background=brblack
$ set -U fish_color_search_match bryellow --background=brblack
$ set -U fish_color_history_current --bold
$ set -U fish_color_operator 00a6b2
$ set -U fish_color_escape 00a6b2
$ set -U fish_color_cwd green
$ set -U fish_color_cwd_root red
$ set -U fish_color_valid_path --underline
$ set -U fish_color_autosuggestion 64DF85
$ set -U fish_color_user brgreen
$ set -U fish_color_host normal
$ set -U fish_color_cancel --reverse
$ set -U fish_pager_color_background
$ set -U fish_pager_color_prefix normal --bold --underline
$ set -U fish_pager_color_progress brwhite --background=cyan
$ set -U fish_pager_color_completion normal
$ set -U fish_pager_color_description B3A06D
$ set -U fish_pager_color_selected_background --background=brblack
$ set -U fish_pager_color_selected_prefix
$ set -U fish_pager_color_selected_completion
$ set -U fish_pager_color_selected_description
$ set -U fish_color_keyword
$ set -U fish_pager_color_secondary_background
$ set -U fish_pager_color_secondary_completion
$ set -U fish_color_option
# Colorscheme: Current
$ set -U fish_color_normal normal
$ set -U fish_pager_color_secondary_description
$ set -U fish_color_host_remote
$ set -U fish_color_command 00BF32
$ set -U fish_pager_color_secondary_prefix
$ set -U fish_color_quote 206676
$ set -U fish_color_redirection 7CB02C
$ set -U fish_color_end 8EEB00
$ set -U fish_color_error 60B9CE
$ set -U fish_color_param 04819E
$ set -U fish_color_comment 5C9900
$ set -U fish_color_match --background=brblue
$ set -U fish_color_selection white --bold --background=brblack
$ set -U fish_color_search_match bryellow --background=brblack
$ set -U fish_color_history_current --bold
$ set -U fish_color_operator 00a6b2
$ set -U fish_color_escape 00a6b2
$ set -U fish_color_cwd green
$ set -U fish_color_cwd_root red
$ set -U fish_color_valid_path --underline
$ set -U fish_color_autosuggestion 64DF85
$ set -U fish_color_user brgreen
$ set -U fish_color_host normal
$ set -U fish_color_cancel --reverse
$ set -U fish_pager_color_background
$ set -U fish_pager_color_prefix normal --bold --underline
$ set -U fish_pager_color_progress brwhite --background=cyan
$ set -U fish_pager_color_completion normal
$ set -U fish_pager_color_description B3A06D
$ set -U fish_pager_color_selected_background --background=brblack
$ set -U fish_pager_color_selected_prefix
$ set -U fish_pager_color_selected_completion
$ set -U fish_pager_color_selected_description
$ set -U fish_color_keyword
$ set -U fish_pager_color_secondary_background
$ set -U fish_pager_color_secondary_completion
$ set -U fish_color_option
$ set -U fish_pager_color_secondary_description
$ set -U fish_color_host_remote
$ set -U fish_pager_color_secondary_prefix
```

用`vi`打开一个`~/.config/fish/config.fish`，将其拷贝到合适的位置，然后执行以下`vi`命令：

```vi
:%s/^\$ set/    set/g
:%s/-U/-g/g
```

结果为：

```fish
if status is-interactive
    # Commands to run in interactive sessions can go here
    # fish color theme
    set -g fish_color_normal normal
    set -g fish_color_command 00BF32
    set -g fish_color_quote 206676
    set -g fish_color_redirection 7CB02C
    set -g fish_color_end 8EEB00
    set -g fish_color_error 60B9CE
    set -g fish_color_param 04819E
    set -g fish_color_comment 5C9900
    set -g fish_color_match --background=brblue
    set -g fish_color_selection white --bold --background=brblack
    set -g fish_color_search_match bryellow --background=brblack
    set -g fish_color_history_current --bold
    set -g fish_color_operator 00a6b2
    set -g fish_color_escape 00a6b2
    set -g fish_color_cwd green
    set -g fish_color_cwd_root red
    set -g fish_color_valid_path --underline
    set -g fish_color_autosuggestion 64DF85
    set -g fish_color_user brgreen
    set -g fish_color_host normal
    set -g fish_color_cancel --reverse
    set -g fish_pager_color_prefix normal --bold --underline
    set -g fish_pager_color_progress brwhite --background=cyan
    set -g fish_pager_color_completion normal
    set -g fish_pager_color_description B3A06D
    set -g fish_pager_color_selected_background --background=brblack
    set -g fish_pager_color_background
    set -g fish_color_host_remote
    set -g fish_color_keyword
    set -g fish_pager_color_selected_prefix
    set -g fish_pager_color_secondary_description
    set -g fish_pager_color_secondary_completion
    set -g fish_color_option
    set -g fish_pager_color_secondary_background
    set -g fish_pager_color_secondary_prefix
    # Colorscheme: Seaweed
    set -g fish_color_normal normal
    set -g fish_pager_color_selected_description
    set -g fish_color_command 00BF32
    set -g fish_pager_color_selected_completion
    set -g fish_color_quote 206676
    set -g fish_color_redirection 7CB02C
    set -g fish_color_end 8EEB00
    set -g fish_color_error 60B9CE
    set -g fish_color_param 04819E
    set -g fish_color_comment 5C9900
    set -g fish_color_match --background=brblue
    set -g fish_color_selection white --bold --background=brblack
    set -g fish_color_search_match bryellow --background=brblack
    set -g fish_color_history_current --bold
    set -g fish_color_operator 00a6b2
    set -g fish_color_escape 00a6b2
    set -g fish_color_cwd green
    set -g fish_color_cwd_root red
    set -g fish_color_valid_path --underline
    set -g fish_color_autosuggestion 64DF85
    set -g fish_color_user brgreen
    set -g fish_color_host normal
    set -g fish_color_cancel --reverse
    set -g fish_pager_color_prefix normal --bold --underline
    set -g fish_pager_color_progress brwhite --background=cyan
    set -g fish_pager_color_completion normal
    set -g fish_pager_color_description B3A06D
    set -g fish_pager_color_selected_background --background=brblack
    set -g fish_pager_color_background
    set -g fish_color_host_remote
    set -g fish_color_keyword
    set -g fish_pager_color_selected_prefix
    set -g fish_pager_color_secondary_description
    set -g fish_pager_color_secondary_completion
    set -g fish_color_option
    set -g fish_pager_color_secondary_background
    set -g fish_pager_color_secondary_prefix
    set -g fish_pager_color_selected_description
    set -g fish_pager_color_selected_completion
end
```

当然，我们还需要按照[`bobthefish`官网](https://github.com/oh-my-fish/theme-bobthefish)的方法进行配置，配置文件全程如下：

```fish
if status is-interactive
    # Commands to run in interactive sessions can go here
    set -g theme_display_git yes
    set -g theme_display_git_dirty yes
    set -g theme_display_git_untracked yes
    set -g theme_display_git_ahead_verbose yes
    set -g theme_display_git_dirty_verbose yes
    set -g theme_display_git_stashed_verbose yes
    set -g theme_display_git_default_branch yes
    set -g theme_git_default_branches master main
    set -g theme_git_worktree_support no
    set -g theme_use_abbreviated_branch_name no
    set -g theme_display_vagrant yes
    set -g theme_display_docker_machine yes
    set -g theme_display_k8s_context yes
    set -g theme_display_hg yes
    set -g theme_display_virtualenv yes
    set -g theme_display_nix yes
    set -g theme_display_ruby yes
    set -g theme_display_node yes
    set -g theme_display_user ssh
    set -g theme_display_hostname ssh
    set -g theme_display_vi no
    set -g theme_display_date yes
    set -g theme_display_cmd_duration yes
    set -g theme_title_display_process yes
    set -g theme_title_display_path yes
    set -g theme_title_display_user yes
    set -g theme_title_use_abbreviated_path no
    set -g theme_date_format "+%a %H:%M"
    set -g theme_date_timezone Asia/Shanghai
    set -g theme_avoid_ambiguous_glyphs yes
    set -g theme_powerline_fonts yes
    set -g theme_nerd_fonts no
    set -g theme_show_exit_status yes
    set -g theme_display_jobs_verbose yes
    set -g default_user jack
    #set -g theme_color_scheme user
    set -g fish_prompt_pwd_dir_length 0
    set -g theme_project_dir_length 1
    set -g theme_newline_cursor yes
    set -g theme_newline_prompt '$ '
    # fish color theme
    set -g fish_color_normal normal
    set -g fish_color_command 00BF32
    set -g fish_color_quote 206676
    set -g fish_color_redirection 7CB02C
    set -g fish_color_end 8EEB00
    set -g fish_color_error 60B9CE
    set -g fish_color_param 04819E
    set -g fish_color_comment 5C9900
    set -g fish_color_match --background=brblue
    set -g fish_color_selection white --bold --background=brblack
    set -g fish_color_search_match bryellow --background=brblack
    set -g fish_color_history_current --bold
    set -g fish_color_operator 00a6b2
    set -g fish_color_escape 00a6b2
    set -g fish_color_cwd green
    set -g fish_color_cwd_root red
    set -g fish_color_valid_path --underline
    set -g fish_color_autosuggestion 64DF85
    set -g fish_color_user brgreen
    set -g fish_color_host normal
    set -g fish_color_cancel --reverse
    set -g fish_pager_color_prefix normal --bold --underline
    set -g fish_pager_color_progress brwhite --background=cyan
    set -g fish_pager_color_completion normal
    set -g fish_pager_color_description B3A06D
    set -g fish_pager_color_selected_background --background=brblack
    set -g fish_pager_color_background
    set -g fish_color_host_remote
    set -g fish_color_keyword
    set -g fish_pager_color_selected_prefix
    set -g fish_pager_color_secondary_description
    set -g fish_pager_color_secondary_completion
    set -g fish_color_option
    set -g fish_pager_color_secondary_background
    set -g fish_pager_color_secondary_prefix
    # Colorscheme: Seaweed
    set -g fish_color_normal normal
    set -g fish_pager_color_selected_description
    set -g fish_color_command 00BF32
    set -g fish_pager_color_selected_completion
    set -g fish_color_quote 206676
    set -g fish_color_redirection 7CB02C
    set -g fish_color_end 8EEB00
    set -g fish_color_error 60B9CE
    set -g fish_color_param 04819E
    set -g fish_color_comment 5C9900
    set -g fish_color_match --background=brblue
    set -g fish_color_selection white --bold --background=brblack
    set -g fish_color_search_match bryellow --background=brblack
    set -g fish_color_history_current --bold
    set -g fish_color_operator 00a6b2
    set -g fish_color_escape 00a6b2
    set -g fish_color_cwd green
    set -g fish_color_cwd_root red
    set -g fish_color_valid_path --underline
    set -g fish_color_autosuggestion 64DF85
    set -g fish_color_user brgreen
    set -g fish_color_host normal
    set -g fish_color_cancel --reverse
    set -g fish_pager_color_prefix normal --bold --underline
    set -g fish_pager_color_progress brwhite --background=cyan
    set -g fish_pager_color_completion normal
    set -g fish_pager_color_description B3A06D
    set -g fish_pager_color_selected_background --background=brblack
    set -g fish_pager_color_background
    set -g fish_color_host_remote
    set -g fish_color_keyword
    set -g fish_pager_color_selected_prefix
    set -g fish_pager_color_secondary_description
    set -g fish_pager_color_secondary_completion
    set -g fish_color_option
    set -g fish_pager_color_secondary_background
    set -g fish_pager_color_secondary_prefix
    set -g fish_pager_color_selected_description
    set -g fish_pager_color_selected_completion
end
```

