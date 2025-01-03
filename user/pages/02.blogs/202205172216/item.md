---
title: 转入hexo，第一篇博客，部署
taxonomy:
    category:
        - hexo
    tag:
        - linux
        - hexo
        - blog
hero_classes: 'text-dark title-h1h2 overlay-light hero-large parallax'
hero_image: unsplash-luca-bravo.jpg
blog_url: /blog
show_sidebar: false
show_breadcrumbs: true
show_pagination: true
subtitle: 'finding beauty in structure'
---

大家好，这是我的第一篇博客，从现在开始，我终于抛弃了Wordpress的旧博客，转入使用静态博客，在这里，我将解释hexo的部署

## 准备工作

首先，我们需要安装hexo，如以下命令行：

```bash
sudo npm install -g yarn
sudo yarn global add hexo
```

执行如下工作生成基本项目：

```bash
hexo init qhjack-blog
```

生成的文件结构如下：

```
./
├── blog
│   ├── 404.md
│   ├── about
│   │   └── index.md
│   ├── categories
│   │   └── index.md
│   ├── _data
│   │   ├── contact.yml
│   │   └── footer_link.yml
│   ├── _posts
│   │   └── hello-world.md
│   ├── search
│   │   └── index.md
│   └── tags
│       └── index.md
├── _config.next.yml
├── _config.yml
├── db.json
├── package.json
├── scaffolds
│   ├── draft.md
│   ├── page.md
│   └── post.md
├── themes
├── yarn-error.log
└── yarn.lock
```

经过一翻折腾，笔者选择的是Next主题

## 安装Next

安装Next比较简单，直接执行以下指令：

```bash
yarn add -D hexo-theme-next
cp node_modules/hexo-theme-next/_config.yml _config.next.yml # 拷贝模板配置文件，官方推荐的方法
yarn add -D hexo-deployer-git
```

这是笔者修改的配置文件：

```yaml
# ===============================================================
# It's recommended to use Alternate Theme Config to configure NexT
# Modifying this file may result in merge conflict
# See: https://theme-next.js.org/docs/getting-started/configuration
# ===============================================================

# ---------------------------------------------------------------
# Theme Core Configuration Settings
# See: https://theme-next.js.org/docs/theme-settings/
# ------------------------------------------------------------
---

# Allow to cache content generation.

cache:
  enable: true

# Remove unnecessary files after hexo generate.

minify: false

# Define custom file paths.

# Create your custom files in site directory `source/_data` and uncomment needed files below.

custom_file_path:
  #head: source/_data/head.njk
  #header: source/_data/header.njk
  #sidebar: source/_data/sidebar.njk
  #postMeta: source/_data/post-meta.njk
  #postBodyEnd: source/_data/post-body-end.njk
  #footer: source/_data/footer.njk
  #bodyEnd: source/_data/body-end.njk
  #variable: source/_data/variables.styl
  #mixin: source/_data/mixins.styl
  #style: source/_data/styles.styl

# ---------------------------------------------------------------

# Scheme Settings

# ---------------------------------------------------------------

# Schemes

scheme: Muse
#scheme: Mist
#scheme: Pisces
#scheme: Gemini

# Dark Mode

darkmode: false

# ---------------------------------------------------------------

# Site Information Settings

# ---------------------------------------------------------------

favicon:
  small: /images/favicon-16x16-next.png
  medium: /images/favicon-32x32-next.png
  apple_touch_icon: /images/apple-touch-icon-next.png
  safari_pinned_tab: /images/logo.svg
  #android_manifest: /manifest.json

# Custom Logo (Warning: Do not support scheme Mist)

custom_logo: #/uploads/custom-logo.jpg

# Creative Commons 4.0 International License.

# See: https://creativecommons.org/about/cclicenses/

creative_commons:

# Available values: by | by-nc | by-nc-nd | by-nc-sa | by-nd | by-sa | cc-zero

  license: by-nc-sa

# Available values: big | small

  size: small
  sidebar: true
  post: true

# You can set a language value if you prefer a translated version of CC license, e.g. deed.zh

# CC licenses are available in 39 languages, you can find the specific and correct abbreviation you need on https://creativecommons.org

  language: zh

# Open graph settings

# See: https://hexo.io/docs/helpers#open-graph

open_graph:
  enable: true
  options:
    #twitter_card: <twitter:card>
    #twitter_id: <twitter:creator>
    #twitter_site: <twitter:site>
    #twitter_image: <twitter:image>
    #google_plus: <g+:profile_link>
    #fb_admins: <fb:admin_id>
    #fb_app_id: <fb:app_id>

# ---------------------------------------------------------------

# Menu Settings

# ---------------------------------------------------------------

# Usage: `Key: /link/ || icon`

# Key is the name of menu item. If the translation for this item is available, the translated text will be loaded, otherwise the Key name will be used. Key is case-sensitive.

# Value before `||` delimiter is the target link, value after `||` delimiter is the name of Font Awesome icon.

# External url should start with http:// or https://

menu:
  home: / || fa fa-home
  about: /about/ || fa fa-user
  tags: /tags/ || fa fa-tags
  categories: /categories/ || fa fa-th
  archives: /archives/ || fa fa-archive
  #schedule: /schedule/ || fa fa-calendar
  sitemap: /sitemap.xml || fa fa-sitemap
  commonweal: /404/ || fa fa-heartbeat

# Enable / Disable menu icons / item badges.

menu_settings:
  icons: true
  badges: false

# ---------------------------------------------------------------

# Sidebar Settings

# See: https://theme-next.js.org/docs/theme-settings/sidebar

# ---------------------------------------------------------------

sidebar:

# Sidebar Position.

  position: left
  #position: right

# Manual define the sidebar width. If commented, will be default for:

# Muse | Mist: 320

# Pisces | Gemini: 240

  #width: 300

# Sidebar Display (only for Muse | Mist), available values:

# - post    expand on posts automatically. Default.

# - always  expand for all pages automatically.

# - hide    expand only when click on the sidebar toggle icon.

# - remove  totally remove sidebar including sidebar toggle.

  display: post

# Sidebar padding in pixels.

  padding: 18

# Sidebar offset from top menubar in pixels (only for Pisces | Gemini).

  offset: 12

# Sidebar Avatar

avatar:

# Replace the default image and set the url here.

  url: #/images/avatar.gif

# If true, the avatar will be displayed in circle.

  rounded: false

# If true, the avatar will be rotated with the cursor.

  rotated: false

# Posts / Categories / Tags in sidebar.

site_state: true

# Social Links

# Usage: `Key: permalink || icon`

# Key is the link label showing to end users.

# Value before `||` delimiter is the target permalink, value after `||` delimiter is the name of Font Awesome icon.

social:
  GitHub: https://github.com/jack9603301 || fab fa-github
  #E-Mail: mailto:yourname@gmail.com || fa fa-envelope
  #Weibo: https://weibo.com/yourname || fab fa-weibo
  #Google: https://plus.google.com/yourname || fab fa-google
  #Twitter: https://twitter.com/yourname || fab fa-twitter
  #FB Page: https://www.facebook.com/yourname || fab fa-facebook
  #StackOverflow: https://stackoverflow.com/yourname || fab fa-stack-overflow
  #YouTube: https://youtube.com/yourname || fab fa-youtube
  #Instagram: https://instagram.com/yourname || fab fa-instagram
  #Skype: skype:yourname?call|chat || fab fa-skype

social_icons:
  enable: true
  icons_only: false
  transition: false

# Blog rolls

links_settings:
  icon: fa fa-globe
  title: Links

# Available values: block | inline

  layout: block

links:
  #Title: https://example.com

# Table of Contents in the Sidebar

# Front-matter variable (nonsupport wrap expand_all).

toc:
  enable: true

# Automatically add list number to toc.

  number: true

# If true, all words will placed on next lines if header width longer then sidebar width.

  wrap: false

# If true, all level of TOC in a post will be displayed, rather than the activated part of it.

  expand_all: false

# Maximum heading depth of generated toc.

  max_depth: 6

# ---------------------------------------------------------------

# Footer Settings

# See: https://theme-next.js.org/docs/theme-settings/footer

# ---------------------------------------------------------------

# Show multilingual switcher in footer.

language_switcher: false

footer:

# Specify the year when the site was setup. If not defined, current year will be used.

  #since: 2021

# Icon between year and copyright info.

  icon:
    # Icon name in Font Awesome. See: https://fontawesome.com/icons
    name: fa fa-heart
    # If you want to animate the icon, set it to true.
    animated: false
    # Change the color of icon, using Hex Code.
    color: "#ff0000"

# If not defined, `author` from Hexo `_config.yml` will be used.

  copyright:

# Powered by Hexo & NexT

  powered: true

# Beian ICP and gongan information for Chinese users. See: https://beian.miit.gov.cn, http://www.beian.gov.cn

  beian:
    enable: false
    icp:
    # The digit in the num of gongan beian.
    gongan_id:
    # The full num of gongan beian.
    gongan_num:
    # The icon for gongan beian. See: http://www.beian.gov.cn/portal/download
    gongan_icon_url:

# ---------------------------------------------------------------

# Post Settings

# See: https://theme-next.js.org/docs/theme-settings/posts

# ---------------------------------------------------------------

# Automatically excerpt description in homepage as preamble text.

excerpt_description: true

# Read more button

# If true, the read more button will be displayed in excerpt section.

read_more_btn: true

# Post meta display settings

post_meta:
  item_text: true
  created_at: true
  updated_at:
    enable: true
    another_day: true
  categories: true

# Post wordcount display settings

# Dependencies: https://github.com/next-theme/hexo-word-counter

symbols_count_time:
  separated_meta: true
  item_text_total: false

# Use icon instead of the symbol # to indicate the tag at the bottom of the post

tag_icon: false

# Donate (Sponsor) settings

# Front-matter variable (nonsupport animation).

reward_settings:

# If true, a donate button will be displayed in every article by default.

  enable: false
  animation: false
  #comment: Buy me a coffee

reward:
  #wechatpay: /images/wechatpay.png
  #alipay: /images/alipay.png
  #paypal: /images/paypal.png
  #bitcoin: /images/bitcoin.png

# Subscribe through Telegram Channel, Twitter, etc.

# Usage: `Key: permalink || icon` (Font Awesome)

follow_me:
  #Twitter: https://twitter.com/username || fab fa-twitter
  #Telegram: https://t.me/channel_name || fab fa-telegram
  #WeChat: /images/wechat_channel.jpg || fab fa-weixin
  #RSS: /atom.xml || fa fa-rss

# Related popular posts

# Dependencies: https://github.com/sergeyzwezdin/hexo-related-posts

related_posts:
  enable: false
  title: # Custom header, leave empty to use the default one
  display_in_home: false

# Post edit

# Easily browse and edit blog source code online.

post_edit:
  enable: false
  url: https://github.com/user-name/repo-name/tree/branch-name/subdirectory-name/ # Link for view source
  #url: https://github.com/user-name/repo-name/edit/branch-name/subdirectory-name/ # Link for fork & edit

# Show previous post and next post in post footer if exists

# Available values: left | right | false

post_navigation: left

# ---------------------------------------------------------------

# Custom Page Settings

# See: https://theme-next.js.org/docs/theme-settings/custom-pages

# ---------------------------------------------------------------

# TagCloud settings for tags page.

tagcloud:
  min: 12 # Minimum font size in px
  max: 30 # Maximum font size in px
  amount: 200 # Total amount of tags
  orderby: name # Order of tags
  order: 1 # Sort order

# Google Calendar

# Share your recent schedule to others via calendar page.

calendar:
  calendar_id: <required> # Your Google account E-Mail
  api_key: <required>
  orderBy: startTime
  showLocation: false
  offsetMax: 72 # Time Range
  offsetMin: 4 # Time Range
  showDeleted: false
  singleEvents: true
  maxResults: 250

# ---------------------------------------------------------------

# Misc Theme Settings

# See: https://theme-next.js.org/docs/theme-settings/miscellaneous

# ---------------------------------------------------------------

# Preconnect CDN for fonts and plugins.

# For more information: https://www.w3.org/TR/resource-hints/#preconnect

preconnect: false

# Set the text alignment in posts / pages.

text_align:

# Available values: start | end | left | right | center | justify | justify-all | match-parent

  desktop: justify
  mobile: justify

# Reduce padding / margin indents on devices with narrow width.

mobile_layout_economy: false

# Browser header panel color.

theme_color:
  light: "#222"
  dark: "#222"

# Override browsers' default behavior.

body_scrollbar:

# Place the scrollbar over the content.

  overlay: false

# Present the scrollbar even if the content is not overflowing.

  stable: false

codeblock:

# Code Highlight theme

# All available themes: https://theme-next.js.org/highlight/

  theme:
    light: default
    dark: stackoverflow-dark
  prism:
    light: prism
    dark: prism-dark

# Add copy button on codeblock

  copy_button:
    enable: false
    # Available values: default | flat | mac
    style:

back2top:
  enable: true

# Back to top in sidebar.

  sidebar: false

# Scroll percent label in b2t button.

  scrollpercent: false

# Reading progress bar

reading_progress:
  enable: false

# Available values: left | right

  start_at: left

# Available values: top | bottom

  position: top
  reversed: false
  color: "#37c6c0"
  height: 3px

# Bookmark Support

bookmark:
  enable: false

# Customize the color of the bookmark.

  color: "#222"

# If auto, save the reading progress when closing the page or clicking the bookmark-icon.

# If manual, only save it by clicking the bookmark-icon.

  save: auto

# `Follow me on GitHub` banner in the top-right corner.

github_banner:
  enable: false
  permalink: https://github.com/yourname
  title: Follow me on GitHub

# ---------------------------------------------------------------

# Font Settings

# ---------------------------------------------------------------

# Find fonts on Google Fonts (https://fonts.google.com)

# All fonts set here will have the following styles:

# light | light italic | normal | normal italic | bold | bold italic

# Be aware that setting too much fonts will cause site running slowly

# ---------------------------------------------------------------

# Web Safe fonts are recommended for `global` (and `title`):

# Arial | Tahoma | Helvetica | Times New Roman | Courier New | Verdana | Georgia | Palatino | Garamond | Comic Sans MS | Trebuchet MS

# ---------------------------------------------------------------

font:
  enable: false

# Uri of fonts host, e.g. https://fonts.googleapis.com (Default).

  host:

# Font options:

# `external: true` will load this font family from `host` above.

# `family: Times New Roman`. Without any quotes.

# `size: x.x`. Use `em` as unit. Default: 1 (16px)

# Global font settings used for all elements inside <body>.

  global:
    external: true
    family: Lato
    size:

# Font settings for site title (.site-title).

  title:
    external: true
    family:
    size:

# Font settings for headlines (<h1> to <h6>).

  headings:
    external: true
    family:
    size:

# Font settings for posts (.post-body).

  posts:
    external: true
    family:

# Font settings for <code> and code blocks.

  codes:
    external: true
    family:

# ---------------------------------------------------------------

# SEO Settings

# See: https://theme-next.js.org/docs/theme-settings/seo

# ---------------------------------------------------------------

# If true, site-subtitle will be added to index page.

# Remember to set up your site-subtitle in Hexo `_config.yml` (e.g. subtitle: Subtitle)

index_with_subtitle: false

# Automatically add external URL with Base64 encrypt & decrypt.

exturl: false

# If true, an icon will be attached to each external URL

exturl_icon: true

# Google Webmaster tools verification.

# See: https://developers.google.com/search

google_site_verification:

# Bing Webmaster tools verification.

# See: https://www.bing.com/webmasters

bing_site_verification:

# Yandex Webmaster tools verification.

# See: https://webmaster.yandex.ru

yandex_site_verification:

# Baidu Webmaster tools verification.

# See: https://ziyuan.baidu.com/site

baidu_site_verification:

# ---------------------------------------------------------------

# Third Party Plugins & Services Settings

# See: https://theme-next.js.org/docs/third-party-services/

# More plugins: https://github.com/next-theme/awesome-next

# You may need to install the corresponding dependency packages

# ---------------------------------------------------------------

# Math Formulas Render Support

# Warning: Please install / uninstall the relevant renderer according to the documentation.

# See: https://theme-next.js.org/docs/third-party-services/math-equations

# Server-side plugin: https://github.com/next-theme/hexo-filter-mathjax

math:

# Default (false) will load mathjax / katex script on demand.

# That is it only render those page which has `mathjax: true` in front-matter.

# If you set it to true, it will load mathjax / katex script EVERY PAGE.

  every_page: false

  mathjax:
    enable: false
    # Available values: none | ams | all
    tags: none

  katex:
    enable: false
    # See: https://github.com/KaTeX/KaTeX/tree/master/contrib/copy-tex
    copy_tex: false

# Easily enable fast Ajax navigation on your website.

# For more information: https://github.com/next-theme/pjax

pjax: false

# FancyBox is a tool that offers a nice and elegant way to add zooming functionality for images.

# For more information: https://fancyapps.com/fancybox/

fancybox: false

# A JavaScript library for zooming images like Medium.

# Warning: Do not enable both `fancybox` and `mediumzoom`.

# For more information: https://medium-zoom.francoischalifour.com

mediumzoom: false

# Vanilla JavaScript plugin for lazyloading images.

# For more information: https://apoorv.pro/lozad.js/demo/

lazyload: false

# Pangu Support

# For more information: https://github.com/vinta/pangu.js

# Server-side plugin: https://github.com/next-theme/hexo-pangu

pangu: false

# Quicklink Support

# For more information: https://getquick.link

# Front-matter variable (nonsupport home archive).

quicklink:
  enable: false

# Home page and archive page can be controlled through home and archive options below.

# This configuration item is independent of `enable`.

  home: false
  archive: false

# Default (true) will initialize quicklink after the load event fires.

  delay: true

# Custom a time in milliseconds by which the browser must execute prefetching.

  timeout: 3000

# Default (true) will attempt to use the fetch() API if supported (rather than link[rel=prefetch]).

  priority: true

# ---------------------------------------------------------------

# Comments Settings

# See: https://theme-next.js.org/docs/third-party-services/comments

# ---------------------------------------------------------------

# Multiple Comment System Support

comments:

# Available values: tabs | buttons

  style: tabs

# Choose a comment system to be displayed by default.

# Available values: disqus | disqusjs | changyan | livere | gitalk | utterances

  active:

# Setting `true` means remembering the comment system selected by the visitor.

  storage: true

# Lazyload all comment systems.

  lazyload: false

# Modify texts or order for any naves, here are some examples.

  nav:
    #disqus:
    #  text: Load Disqus
    #  order: -1
    #gitalk:
    #  order: -2

# Disqus

# For more information: https://disqus.com

disqus:
  enable: false
  shortname:
  count: true

# DisqusJS

# For more information: https://disqusjs.skk.moe

disqusjs:
  enable: false

# API Endpoint of Disqus API (https://disqus.com/api/docs/).

# Leave api empty if you are able to connect to Disqus API. Otherwise you need a reverse proxy for it.

# For example:

# api: https://disqus.skk.moe/disqus/

  api:
  apikey: # Register new application from https://disqus.com/api/applications/
  shortname: # See: https://disqus.com/admin/settings/general/

# Changyan

# For more information: https://changyan.kuaizhan.com

changyan:
  enable: false
  appid:
  appkey:

# LiveRe comments system

# You can get your uid from https://livere.com/insight/myCode (General web site)

livere_uid: # <your_uid>

# Gitalk

# For more information: https://gitalk.github.io

gitalk:
  enable: false
  github_id: # GitHub repo owner
  repo: # Repository name to store issues
  client_id: # GitHub Application Client ID
  client_secret: # GitHub Application Client Secret
  admin_user: # GitHub repo owner and collaborators, only these guys can initialize gitHub issues
  distraction_free_mode: true # Facebook-like distraction free mode

# When the official proxy is not available, you can change it to your own proxy address

  proxy: https://cors-anywhere.azm.workers.dev/https://github.com/login/oauth/access_token # This is official proxy address

# Gitalk's display language depends on user's browser or system environment

# If you want everyone visiting your site to see a uniform language, you can set a force language value

# Available values: en | es-ES | fr | ru | zh-CN | zh-TW

  language:

# Utterances

# For more information: https://utteranc.es

utterances:
  enable: false
  repo: user-name/repo-name # Github repository owner and name

# Available values: pathname | url | title | og:title

  issue_term: pathname

# Available values: github-light | github-dark | preferred-color-scheme | github-dark-orange | icy-dark | dark-blue | photon-dark | boxy-light

  theme: github-light

# Isso

# For more information: https://posativ.org/isso/

isso: # <data_isso>

# ---------------------------------------------------------------

# Post Widgets & Content Sharing Services

# See: https://theme-next.js.org/docs/third-party-services/post-widgets

# ---------------------------------------------------------------

# Star rating support to each article.

# To get your ID visit https://widgetpack.com

rating:
  enable: false
  id:     # <app_id>
  color:  "#fc6423"

# AddThis Share. See: https://www.addthis.com

# Go to https://www.addthis.com/dashboard to customize your tools.

add_this_id:

# ---------------------------------------------------------------

# Statistics and Analytics

# See: https://theme-next.js.org/docs/third-party-services/statistics-and-analytics

# ---------------------------------------------------------------

# Google Analytics

# See: https://analytics.google.com

google_analytics:
  tracking_id: # <app_id>

# By default, NexT will load an external gtag.js script on your site.

# If you only need the pageview feature, set the following option to true to get a better performance.

  only_pageview: false

# Baidu Analytics

# See: https://tongji.baidu.com

baidu_analytics: # <app_id>

# Growingio Analytics

# See: https://www.growingio.com

growingio_analytics: # <project_id>

# Cloudflare Web Analytics

# See: https://www.cloudflare.com/web-analytics/

cloudflare_analytics:

# Microsoft Clarity Analytics

# See: https://clarity.microsoft.com/

clarity_analytics: # <project_id>

# Show number of visitors of each article.

# You can visit https://www.leancloud.cn to get AppID and AppKey.

leancloud_visitors:
  enable: false
  app_id: # <your app id>
  app_key: # <your app key>

# Required for apps from CN region

  server_url: # <your server url>

# Dependencies: https://github.com/theme-next/hexo-leancloud-counter-security

# If you don't care about security in leancloud counter and just want to use it directly

# (without hexo-leancloud-counter-security plugin), set `security` to `false`.

  security: true

# Another tool to show number of visitors to each article.

# Visit https://console.firebase.google.com/u/0/ to get apiKey and projectId.

# Visit https://firebase.google.com/docs/firestore/ to get more information about firestore.

firestore:
  enable: false
  collection: articles # Required, a string collection name to access firestore database
  apiKey: # Required
  projectId: # Required

# Show Views / Visitors of the website / page with busuanzi.

# For more information: http://ibruce.info/2015/04/04/busuanzi/

busuanzi_count:
  enable: false
  total_visitors: true
  total_visitors_icon: fa fa-user
  total_views: true
  total_views_icon: fa fa-eye
  post_views: true
  post_views_icon: far fa-eye

# ---------------------------------------------------------------

# Search Services

# See: https://theme-next.js.org/docs/third-party-services/search-services

# ---------------------------------------------------------------

# Algolia Search

# For more information: https://www.algolia.com

algolia_search:
  enable: false
  hits:
    per_page: 10

# Local Search

# Dependencies: https://github.com/next-theme/hexo-generator-searchdb

local_search:
  enable: true

# If auto, trigger search by changing input.

# If manual, trigger search by pressing enter key or search button.

  trigger: auto

# Show top n results per article, show all results by setting to -1

  top_n_per_article: 1

# Unescape html strings to the readable one.

  unescape: false

# Preload the search data when the page loads.

  preload: false

# ---------------------------------------------------------------

# Chat Services

# See: https://theme-next.js.org/docs/third-party-services/chat-services

# ---------------------------------------------------------------

# A button to open designated chat widget in sidebar.

# Firstly, you need to enable and configure the chat service.

chat:
  enable: false
  icon: fa fa-comment # Icon name in Font Awesome, set false to disable icon.
  text: Chat # Button text, change it as you wish.

# Chatra Support

# For more information: https://chatra.com

# Dashboard: https://app.chatra.io/settings/general

chatra:
  enable: false
  async: true
  id: # Visit Dashboard to get your ChatraID
  #embed: # Unfinished experimental feature for developers. See: https://chatra.com/help/api/#injectto

# Tidio Support

# For more information: https://www.tidio.com

# Dashboard: https://www.tidio.com/panel/dashboard

tidio:
  enable: false
  key: # Public Key, get it from dashboard. See: https://www.tidio.com/panel/settings/developer

# Gitter Support

# For more information: https://gitter.im

gitter:
  enable: false
  room:

# ---------------------------------------------------------------

# Tags Settings

# See: https://theme-next.js.org/docs/tag-plugins/

# ---------------------------------------------------------------

# Note tag (bootstrap callout)

note:

# Note tag style values:

# - simple    bootstrap callout old alert style. Default.

# - modern    bootstrap callout new (v2-v3) alert style.

# - flat      flat callout style with background, like on Mozilla or StackOverflow.

# - disabled  disable all CSS styles import of note tag.

  style: simple
  icons: false

# Offset lighter of background in % for modern and flat styles (modern: -12 | 12; flat: -18 | 6).

# Offset also applied to label tag variables. This option can work with disabled note tag.

  light_bg_offset: 0

# Tabs tag

tabs:

# Make the nav bar of tabs with long content stick to the top.

  sticky: false
  transition:
    tabs: false
    labels: true

# PDF tag

# NexT will try to load pdf files natively, if failed, pdf.js will be used.

# So, you have to install the dependency of pdf.js if you want to use pdf tag and make it available to all browsers.

# Dependencies: https://github.com/next-theme/theme-next-pdf

pdf:
  enable: false

# Default height

  height: 500px

# Mermaid tag

mermaid:
  enable: false

# Available themes: default | dark | forest | neutral

  theme:
    light: default
    dark: dark

# ---------------------------------------------------------------

# Animation Settings

# ---------------------------------------------------------------

# Use Animate.css to animate everything.

# For more information: https://animate.style

motion:
  enable: true
  async: false
  transition:
    # All available transition variants: https://theme-next.js.org/animate/
    post_block: fadeIn
    post_header: fadeInDown
    post_body: fadeInDown
    coll_header: fadeInLeft
    # Only for Pisces | Gemini.
    sidebar: fadeInUp

# Progress bar in the top during page loading.

# For more information: https://github.com/CodeByZach/pace

pace:
  enable: false

# All available colors:

# black | blue | green | orange | pink | purple | red | silver | white | yellow

  color: blue

# All available themes:

# big-counter | bounce | barber-shop | center-atom | center-circle | center-radar | center-simple

# corner-indicator | fill-left | flat-top | flash | loading-bar | mac-osx | material | minimal

  theme: minimal

# Canvas ribbon

# For more information: https://github.com/hustcc/ribbon.js

canvas_ribbon:
  enable: false
  size: 300 # The width of the ribbon
  alpha: 0.6 # The transparency of the ribbon
  zIndex: -1 # The display level of the ribbon

# ---------------------------------------------------------------

# CDN Settings

# See: https://theme-next.js.org/docs/advanced-settings/vendors

# ---------------------------------------------------------------

vendors:

# The CDN provider of NexT internal scripts.

# Available values: local | jsdelivr | unpkg | cdnjs | custom

# Warning: If you are using the latest master branch of NexT, please set `internal: local`

  internal: local

# The default CDN provider of third-party plugins.

# Available values: local | jsdelivr | unpkg | cdnjs | custom

# Dependencies for `plugins: local`: https://github.com/next-theme/plugins

  plugins: jsdelivr

# Custom CDN URL

# For example:

# custom_cdn_url: https://cdn.jsdelivr.net/npm/${npm_name}@${version}/${minified}

# custom_cdn_url: https://cdnjs.cloudflare.com/ajax/libs/${cdnjs_name}/${version}/${cdnjs_file}

  custom_cdn_url:

# Assets

# Accelerate delivery of static files using a CDN

# The js option is only valid when vendors.internal is local.

css: css
js: js
images: images
```

需要为一些菜单创建目录和文件：

```bash
hexo new page about
```

编辑`blog/about/index.md`，这里我就不丢出来了，网页里面有

```bash
hexo new page tags
```

编辑`blog/tags/index.md`，增加一行frontmatter：

```markdown
---
type: tags
---
```

解析来和上面一样，创建分类：

```bash
hexo new page categories
```

编辑`blog/categories/index.md`，增加一行frontmatter：

```markdown
---
type: categories
---
```

## 进一步配置

笔者开启了搜索，因此需要安装如下：

```bash
yarn add -D hexo-generator-search
```

在主配置文件中增加以下内容：

```yaml
search:
  path: search.xml
  field: post
  format: html
  limit: 10000
```

## 激活主题

在主配置文件中修改以下配置：

```yaml
theme: next
```

## 部署配置

为了方便，我们应该在主配置下配置如下段：

```yaml
deploy:
  type: git
  repo: https://gitee.com/jack960330/qhjack-blog
```

## 完整配置

接下来就是一些hexo博客基本信息配置了，包括以下配置信息：

1. 博客主题（`title`配置）
2. 博客详解（`description`配置）
3. 主页地址（`url`配置）
4. 时区配置（`timezone`配置）
5. 语言配置（`language`配置）
6. 博客关键字配置（`keyword`配置）

完整hexo主配置如下：

```yaml
# Hexo Configuration
## Docs: https://hexo.io/docs/configuration.html
## Source: https://github.com/hexojs/hexo/

# Site
title: 起航天空
subtitle: ''
description: '在茫茫之中，探索自然奥秘，在星星之源，绽放声明之花。起航天空，引领你的未来，配棒你的一生！'
keywords: 起航, 起航天空, 探索, 博客, 生命
language: zh-CN
timezone: 'Asia/Shanghai'

# URL
## Set your site url here. For example, if you use GitHub Page, set url as 'https://username.github.io/project'
url: http://jack960330.gitee.io
permalink: :year/:month/:day/:title/
permalink_defaults:
pretty_urls:
  trailing_index: true # Set to false to remove trailing 'index.html' from permalinks
  trailing_html: true # Set to false to remove trailing '.html' from permalinks

# Directory
source_dir: blog
public_dir: public
tag_dir: tags
archive_dir: archives
category_dir: categories
code_dir: downloads/code
i18n_dir: :lang
skip_render:

# Writing
new_post_name: :title.md # File name of new posts
default_layout: post
titlecase: false # Transform title into titlecase
external_link:
  enable: true # Open external links in new tab
  field: site # Apply to the whole site
  exclude: ''
filename_case: 0
render_drafts: false
post_asset_folder: false
relative_link: false
future: true
highlight:
  enable: true
  line_number: true
  auto_detect: false
  tab_replace: ''
  wrap: true
  hljs: false
prismjs:
  enable: false
  preprocess: true
  line_number: true
  tab_replace: ''

# Home page setting
# path: Root path for your blogs index page. (default = '')
# per_page: Posts displayed per page. (0 = disable pagination)
# order_by: Posts order. (Order by date descending by default)
index_generator:
  path: ''
  per_page: 10
  order_by: -date

# Category & Tag
default_category: uncategorized
category_map:
tag_map:

# Metadata elements
## https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta
meta_generator: true

# Date / Time format
## Hexo uses Moment.js to parse and display date
## You can customize the date format as defined in
## http://momentjs.com/docs/#/displaying/format/
date_format: YYYY-MM-DD
time_format: HH:mm:ss
## updated_option supports 'mtime', 'date', 'empty'
updated_option: 'mtime'

# Pagination
## Set per_page to 0 to disable pagination
per_page: 10
pagination_dir: page

# Include / Exclude file(s)
## include:/exclude: options only apply to the 'source/' folder
include:
exclude:
ignore:

# Extensions
## Plugins: https://hexo.io/plugins/
## Themes: https://hexo.io/themes/
theme: next

# Deployment
## Docs: https://hexo.io/docs/one-command-deployment
deploy:
  type: git
  repo: https://gitee.com/jack960330/qhjack-blog

search:
  path: search.xml
  field: post
  format: html
  limit: 10000
```
