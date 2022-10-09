---
title: 在Debian 11中源码编译mysql 8.0.30
tags:
  - linux
categories: linux
author: Xie Bruce
comments: true
post_link: 'https://www.xiebruce.top/1811.html'
copyright_reprint: true
abbrlink: 516259959
date: 2022-10-09 23:24:02
description: 在Debian中源码编译mysql 8.0.30，整个过程比较详细的解释了一些很多文章没有写，但是很多人又不太懂的知识。
---


# 在Debian 11中源码编译mysql 8.0.30

### 下载源码包
说实话，mysql的源码包下载地址真的是很难找，不像nginx, php, redis，直接github上就有。要找mysql的源码包，我们需要从mysql的文档一步一步的找。

- 1、首先进入[mysql.com](https://mysql.com/)，这个大家应该都知道，猜大概也能猜出来，一般这种程序官网，不是.com就是.org的，再不行就网上搜一下，反正不至于连官网都找不到吧；
- 2、官方上有个“DOWNLOADS”菜单，表示下载，我们点击[DOWNLOADS](https://www.mysql.com/downloads/)；
- 3、往下滚动，我们可以看到一个“MySQL Community (GPL) Downloads »”链接，这个Community是社区版的意思，这才是我们需要的，点击[MySQL Community (GPL) Downloads »](https://dev.mysql.com/downloads/)进入该页面；
- 4、从上一步进入的页面中我们找到“MySQL Community Server”，这个才是我们需要的，点击[MySQL Community Server](https://dev.mysql.com/downloads/)，进入该页面；
- 5、上一步操作后我们会进入到[MySQL Community Downloads](https://dev.mysql.com/downloads/mysql/)页面，然后我们要选择一下操作系统和对应的版本，由于我们是源码编译，所以选择“Source Code”，对应的版本，由于我们是在Debian中编译，所以选择最后一个“All Operating Systems (Generic) (Architecture Independent)”，最终如下图所示
![](https://img.xiebruce.top/2022/10/09/8be61e6ced7d9b69d3eab95e8c50fc78.jpg)

上图需要下载第二个，即包含“Includes Boost Headers”的那个，Boost是一个`C++`标准库，因为mysql主要是用`C++`写的，它依赖于`C++`标准库(即Boost)，如果你下载第一个，那么你还要自己去下载Boost，而且你自己下载的版本还未必对的上你此时需要编译的mysql的版本，所以我们直接下载带boost库的，这样mysql官方已经给你匹配好了版本。

上图点击Download后，它会跳转到下图，其中“No thanks, just start download.”这个链接就是下载链接，你可以直接点击它下载，也可以右击它→复制链接，然后用wget或curl来下载(在Linux服务器中一般用这种方法)
![](https://img.xiebruce.top/2022/10/09/6a088a1ec33522aaca9b3aa070f22c0f.jpg)

由于我是在Linux服务器中编译，所以我选择右击上图中的“No thanks, just start download.” →复制链接，然后在Linux服务器中用wget来下载
```bash
wget https://dev.mysql.com/get/Downloads/MySQL-8.0/mysql-boost-8.0.30.tar.gz
```

### 编译前依赖准备
源码编译mysql前，系统中必须提前准备的东西：[先决条件](https://dev.mysql.com/doc/refman/8.0/en/source-installation-prerequisites.html)。

- 1、cmake 3.75或更高的版本；
- 2、gcc 7.1或更高版本
- 3、g++
- 4、openssl 1.0.1或更高版本；
- 5、Boost(一个C++标准库，我们下载的Mysql已经是带Boost的了)；
- 6、ncurses库
- 7、充足的内存（最好有2GB以上的空闲内存，不够的话就添加虚拟内存）；
- 8、perl(如果你要做test的话，不做test就不需要)。

上边列出的依赖安装如下(pkg-config虽然未列出，但也是必须的)
```bash
# 更新apt缓存
apt update
# 安装C语言编译器
apt install -y gcc
# 安装C++编译器
apt install -y g++
# 安装cmake
apt install -y cmake
# pkg-config用于在编译程序时，自动给编译器添加合适的编译选项
apt install -y pkg-config
# 安装openssl
apt install libssl1.1 libssl-dev
# Curses
apt install -y libncurses5-dev libncursesw5-dev

# 上边全部集合到一条命令(不同发行版包名可能不同，比如就算是Ubuntu也可能跟debian不同，虽然都是apt安装)
apt update && apt install -y gcc g++ cmake pkg-config libssl1.1 libssl-dev libncurses5-dev libncursesw5-dev
```

### 关于编译
C/C++语言编写的程序，源码编译都是用`make`命令编译，然后用`make install`命令安装，但关键是在编译之前需要生成一个“Makefile”文件，然后`make`命令才能根据这个Makefile来编译，目前生成Makefile的方法有两种：

- 1、**AutoTools方式**：如果源码中有`configure`文件，那就代表用的是AutoTools(包含`autoconf`,`autotools`,`libtool`)方式，`configure`文件就是编写程序的人用`autoconf`和`automake`这两个工具生成的，我们执行`./configure`即可生成Makefile，当然configure也是有很多参数的，你可以执行`./configure --help`来查找有哪些参数，结合程序官方文档或网上资料，给定你需要的参数再来执行configure命令，一般来说会有一个`--prefix=/path/to/xxx/`用于指定把编译好的程序安装到哪个文件夹中；
- 2、**cmake方式**：cmake会根据源码包中的CMakeLists.txt文件生成Makefile。

以上两种方式，无论是哪种，都需要`gcc`(C语言编译器，是GNU Compiler Collection的缩写，中文翻译GNU编译器集合)，如果你的程序是`C++`写的，还需要`g++`(`C++`编译器)，并且还需要`pkg-config`(用于自动给编译器添加合适的编译选项)。

除了以上这些必须的，还需要预先安装你所编译的程序的依赖，比如mysql就需要依赖boost,openssl,ncurses，一般来说都可以直接用包管理工具(比如apt,apt-get,yum,dnf等等)安装这些依赖，但是如果你的Linux发行版太老(比如Centos7这种老掉牙的系统，就算你安装epel-release也未必能拯救它，所以你用yum在centos7安装的包很可能是比较低的版本而导致不符合你所编译的程序所要求的版本，此时你就不得不要自己编译高版本的，而自己编译又可能会因为你这个依赖本身又依赖于另一个程序，而另一个程序版本如果又太低，又需要手动编译，而它还可能依赖于另外一个程序，这样循环依赖，导致问题非常复杂甚至无法解决，解决办法就是换debian, ubuntu这些好点的系统，当然你换centos8也行，但由于centos8官方放弃支持了，所以还是别用了，我强烈推荐debian)。

### 编译
解压前面下载好的源码包
```bash
tar -vzxf mysql-boost-8.0.30.tar.gz
```

进入源码包，`ls -l`查看里面的文件
```bash
cd mysql-8.0.30
ls -l
```
发现没有`configure`文件，但是有一个“CMakeLists.txt”文件，说明mysql是需要用cmake来编译的。

cmake编译的一般方法，是在源码包内新建一个文件夹(一般命令为“build”)，然后在里面执行`cmake`(当然，像`./configure`一样，它也需要添加一些选项的)，这样cmake产生的文件就都会在build文件夹下，如果cmake出错，解决错误(比如安装错误提示的依赖)后，删除build文件夹下的所有文件，重新cmake即可。

按上面的说法，我们在mysql源码文件夹中新建一个build文件夹并进入该文件夹
```bash
mkdir build
cd build
```

**然后在该文件夹下执行cmake，具体加哪些参数呢？请往下看：**

1、使用SysV方式启动，cmake命令如下
```bash
# 对上层目录，其实就是mysql源码进行cmake，用于生成Makefile文件
cmake -DWITH_BOOST=../boost/boost_1_77_0/ -DCMAKE_INSTALL_PREFIX=/usr/local/mysql/ ..
```

2、使用systemd方式启动(`-DWITH_SYSTEMD=1`)，cmake命令如下
```bash
# 生成systemd文件(即用于放到`/etc/systemd/systemd`中的文件)，否则默认是用SysV方式启动的，文件会放
# 在/etc/init.d/中，当然SysV方式也是可以用systemctl来调用的，只不过它会自动调用/etc/init.d/中的文件
# 如果在docker中，就不能用systemd的方式了，因为docker中没有systemd
cmake -DWITH_BOOST=../boost/boost_1_77_0/ -DWITH_SYSTEMD=1 -DCMAKE_INSTALL_PREFIX=/usr/local/mysql/ ..
```

3、使用官方的cmake选项(`-DBUILD_CONFIG=mysql_release`)，命令如下
```bash
cmake -DWITH_BOOST=../boost/boost_1_77_0/ -DBUILD_CONFIG=mysql_release -DCMAKE_INSTALL_PREFIX=/usr/local/mysql/ ..
```

根据以上命令，我们知道cmake肯定需要一些参数的，比如你想把mysql安装到哪个文件夹，比如对于mysql来说，你需要指定boost(C++标准库)头文件在哪儿等等，那怎么知道这些参数的名称呢？怎么知道在哪个参数呢？

如果你熟悉configure编译方式，你应该知道`configure`是可以直接用`/.configure -h`查看到它有哪些选项的，然而`cmake -h`虽然能出来一些选项，但这些选项并不是你所要编译的程序的选项，所以你要编译的程序有哪些选项，还得你看程序的官方文档，或者网上找别人发布的资料，另外你还可以看“CMakeLists.txt”源码，它里面的注释或源码肯定会提到选项的。

我找到的mysql的cmake参数在[CMake Option Reference](https://dev.mysql.com/doc/refman/8.0/en/source-configuration-options.html#cmake-option-reference)，如下图所示，之所以叫“Reference”，是因为这个表中的选项不是真正能用于`cmake`的选项，它只是一个链接，你需要找到对应的选项点进去，它会滚动到下边真正的选项中
![](https://img.xiebruce.top/2022/10/09/aa55a4af3cf40d1cffa28b1d05e49d72.jpg)

比如`-DWITH_BOOST`这个选项用于指定boost(C++标准库)头文件位置，由于我们下载的mysql是带boost的，所以我们只需要指定它的相对路径即可，又比如`-DCMAKE_INSTALL_PREFIX`用于指定程序安装位置，需要指定绝对路径，其它参数请自行看[这里](https://dev.mysql.com/doc/refman/8.0/en/source-configuration-options.html#option_cmake_with_boost)，要哪些参数只能根据经验或者网上查别人的教程，或者自己挨个参数看，看是不是自己需要设置的。

cmake完成后，你会发现build目录下已经生成了一个Makefile文件了(当然还有很多其它文件)，现在我们可以执行`make`命令进行编译了，编译完成后执行`make install`安装，当然这两部经常会一起写，用`&&`连接两个命令，如下所示
```bash
make && make install
```

一些需要注意的地方：

- 如果cmake错误，可删除build目录中的文件即可清除cache重新cmake；
- 如果make错误，可以执行`make clean`后再make；
- 如果make没有错误，而是由于cpu、内存等不够，或者人为`control+c`中断了，可以直接make，不用再`make clean`，因为mysql比较大，make的过程非常花时间，如果全部重新make，那会很花时间，而且没必要，只要不是因为错误中断的，就可以直接再次make，这样它会跳过已经make的。

内存不足容易出现类似以下这样的报错(一般会在40%左右进度的时候报错，我遇到过好几次)，这与具体哪个文件报错无关，反正这种格式的报错就是内存不足，需要添加虚拟内存或者先停止一些占用内存的服务，然后重新运行`make`命令(不需要删除build目录下的文件，这样它会跳过已经make过的，否则又重头开始，就很慢了)
```bash
c++: fatal error: Killed signal terminated program cc1plus
compilation terminated.
make[2]: *** [sql/CMakeFiles/sql_gis.dir/build.make:146: sql/CMakeFiles/sql_gis.dir/gis/difference_functor.cc.o] Error 1
make[1]: *** [CMakeFiles/Makefile2:28998: sql/CMakeFiles/sql_gis.dir/all] Error 2
make: *** [Makefile:166: all] Error 2
```

### 初始化数据目录
从[文档](https://dev.mysql.com/doc/refman/8.0/en/data-directory-initialization.html)中可以看到，安装步骤安装完之后，接下来就是“Postinstallation Setup and Testing”，意思是“安装后要做的设置与测试”，从下图我们可以看到，安装完第一件事就是“初始化数据目录”
![](https://img.xiebruce.top/2022/10/09/3329807db862264ee4d38f9eb717d9c5.jpg)

初始化数据目录的官方文档是：[Data Directory Initialization Overview](https://dev.mysql.com/doc/refman/8.0/en/data-directory-initialization.html#data-directory-initialization-overview)，它本质上会在`/usr/local/mysql/`目录下生成一个“data”文件夹，命令如下
```bash
# 安全模式初始化：会生成一个默认root密码
mysqld --initialize --user=mysql

# 非安全模式初始化：不生成默认root密码，即root密码为空
mysqld --initialize --initialize-insecure --user=mysql

# 非安全模式也可省略--initialize
mysqld --initialize-insecure --user=mysql
```

但是以上命令直接执行肯定是不行的，因为mysql的bin目录没有加入环境变量，你直接执行它是识别不了的，我们需要先把mysql的bin目录加入到环境变量，添加之后就可以运行上面的初始化命令了
```bash
# 如果你是用bash
echo "export PATH=/usr/local/mysql/bin:$PATH" >> ~/.bashrc

# 如果你是用zsh
echo "export PATH=/usr/local/mysql/bin:$PATH" >> ~/.zshrc

# 无论是用bash还是zsh，添加之后都要用source加载一下对应的配置文件才会生效
source ~/.bash
source ~/.zshrc
```

安全模式初始化(默认生成一个root密码，注意查看它的输出，如下图所示，一定要把输出的密码先复制下来，免得忘了，如果实在是找不到，那就删掉“data”文件夹重新初始化一次)
![](https://img.xiebruce.top/2022/10/09/595181caccd93ef7760b20a7f404e729.jpg)

非安全模式初始化(root密码为空)
![](https://img.xiebruce.top/2022/10/09/ba6c9db9ed998a6fc115bb6a3a6b1065.jpg)

**到底要用哪个方式初始化？**
其实用安全模式和非安全模式问题都不大，因为这两种模式的唯一区分，无非就是创建的初始用户`root`有没有密码的问题，安全模式会生成一个默认密码，非安全模式是空密码，但由于创建的初始用户只能在本机登录，外网是登录不了的，所以除非有人能登录你的机器，否则就算mysql没有密码，那也没人能登录。

**初始化过程做了什么事？**

- 1、在mysql安装目录下创建一个名为“data”的文件夹，如果该文件夹已存在且不为空，则会报错；
- 2、在数据目录中创建mysql系统模式(schema)及其表，包括数据字典表、授权表、时区表和服务器端帮助表；
- 3、初始化系统表空间和管理InnoDB表所需的相关数据结构；
- 4、创建一个'root'@'localhost'超级用户和其他保留用户(比如`'mysql.sys'@'localhost'`，`'mysql.session'@'localhost'`和`'mysql.infoschema'@'localhost'`)；
- 5、填充用于help语句的服务器端帮助表，但不会填充时区表，如果要填充，可以这样
```bash
./mysql_tzinfo_to_sql /usr/share/zoneinfo | mysql -u root -p mysql
```
其中`mysql_tzinfo_to_sql`是`/usr/local/bin/`下的命令，`/usr/share/zoneinfo`是Linux下的时区信息目录，`mysql_tzinfo_to_sql`命令可以把`/usr/share/zoneinfo`下的zone信息变成sql语句，然后再通过管道符`|`导入到mysql数据库中，`mysql -u root -p mysql`中的`mysql`是指数据库名而不是密码。你也可以先把sql语句保存到文件中再导入
```bash
# 生成时区信息sql语句
./mysql_tzinfo_to_sql /usr/share/zoneinfo > /path/to/zoneinfo.sql

# 把时区信息导入到名为“mysql”的数据库中
mysql -u root -p mysql < /path/to/zoneinfo.sql
```
- 6、如果你传了`--init-file=/path/to/xxx.sql`，则会额外执行`xxx.sql`中的语句，相当于可以执行一些自定义的初始化命令，这个一般不需要传，因为就算你有这个需求也可以之后再执行；

### 编写配置文件
我们可以打开以下文件(是一个shell脚本文件)，它里面的注释或者源码就有写去哪里找配置文件
```bash
/usr/local/mysql/support-files/mysql.server
```

从上边的mysql.server脚本中的注释或代码可知，它会去`~/.my.cnf`和`/etc/my.cnf`这两个位置找配置文件， 当然如果在cmake时你用了`-DSYSCONFDIR=/usr/local/etc/`指定了配置文件的文件夹，那么它也会去`/usr/local/etc/`文件夹下找my.cnf(这是我猜的，没实际测试，因为编译一次时间实在太长了)。

我们新建一个`/etc/my.cnf`配置文件，并粘贴上以下内容(配置文件有非常多选项可以配置，以下只是示例)
```ini
[mysqld]
datadir=/usr/local/mysql/var
socket=/var/tmp/mysql.sock
port=3306
user=mysql
```

### 启动mysqld服务
`mysqld`是mysql的服务器端可执行文件，启动mysqld服务就是运行`mysqld`，但我们一般不用它直接启动，而是用`mysqld_safe`(这是一个shell脚本文件，它内部会调用mysqld，你可以打开看看)，这两个文件路径都在mysql安装目录下的bin目录下
```bash
/usr/local/mysql/bin/mysqld
/usr/local/mysql/bin/mysqld_safe
```

**mysqld_safe与mysqld的区别**：
相比mysqld，mysqld_safe增加了一些安全特性，例如在发生错误时重新启动服务器，并将运行时信息记录到错误日志中，但它本质还是调用mysqld来启动的，只不过在启动或停止之前，做一些检查以及记录一下日志等等。

使用mysql_safe启动
```bash
mysqld_safe --defaults-file=/path/to/my.cnf
```

---

如果cmake时没有用这个选项`-DWITH_SYSTEMD=1`，则启动方式如下
```bash
# 进入support-files文件夹
cd /usr/local/mysql/support-files/

# 启动mysqld服务
./mysql.server start
```

不过我们一般会把`mysql.server`复制一份到`/etc/init.d/`下并重命名为`mysqld`
```bash
cp /usr/local/mysql/support-files/mysql.server /etc/init.d/mysqld
```

然后就可以用service方式启动/停止/重启了(另外记得用`chkconfig`(centos)或`update-rc.d`(debian)来加入开机自启动)
```bash
service mysqld start|stop|restart
```

---

如果cmake时用了这个选项`-DWITH_SYSTEMD=1`，则会在mysql安装目录(`/usr/local/mysql/`)下的`lib/systemd/system/`目录下生成以下三个文件
```bash
-rw-r--r-- 1 root root 2058 Oct  9 02:56 mysqld.service
-rw-r--r-- 1 root root 2089 Oct  9 02:56 mysqld@.service
-rw-r--r-- 1 root root 1437 Oct  9 02:56 mysqlrouter.service
```
理论上我们需要把它们全部拷贝到`/etc/systemd/system/`目录下才能使用它们，但实际上，我们一般只会用到`mysqld.service`，所以其实我们只复制这一个过去就行
```bash
cp /usr/local/mysql/lib/systemd/system/mysqld.service /etc/systemd/system/
```
说一下第三个(即`mysqlrouter`)，MySQL Router是一个介于应用层和DB层之间的开源的轻量级中间件，它能够将前端应用的请求分析转发给后端DB服务器处理，从而实现DB的负载均衡，可以说它是先前MySQL Proxy的替代品，我们可以在Github找到它的源码，类似的工具有360的Atlas、美团点评的DBProxy、MyCat等几种。

拷贝过去之后，我们执行`systemctl status mysqld`就能查看到它的状态如下
```bash
○ mysqld.service - MySQL Server
     Loaded: loaded (/etc/systemd/system/mysqld.service; disabled; vendor preset: enabled)
     Active: inactive (dead)
       Docs: man:mysqld(8)
             http://dev.mysql.com/doc/refman/en/using-systemd.html
```

接下来就是设置开机自启动
```bash
systemctl enable mysqld
```

然后就可以用这种方式来启动/停止/重启mysql了
```bash
systemctl start|stop|restart mysqld
```

### 修改root密码
按上边的方法启动mysql服务器之后，我们首先需要修改root密码(无论初始化的时候有临时密码还是空密码，都需要修改密码)。

要修改密码，首先要登录到mysql服务器
```bash
# 如果有临时密码，则用这个方式登录，然后输入临时密码，如果忘了临时密码，那就删掉“data”目录重新初始化
mysql -u root -p

# 如果没有临时密码，就用这个命令登录(其实不用“--skip-password”也一样可以)
mysql -u root --skip-password
```

登录后，把root密码设置为“123456”(注意你不要学我，你应该把123456换成你自己想要设置的密码)
```sql
mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY '123456';
Query OK, 0 rows affected (0.00 sec)
```

另外我们可以执行一下`show databases;`，可以看到这四个数据库就是我们初始化的时候创建的(包含它们里面的表)
```sql
mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mysql              |
| performance_schema |
| sys                |
+--------------------+
4 rows in set (0.01 sec)
```

至此，mysql源码安装整个过程就完成了！程就完成了！

### 运行初始化安全设置
在`/usr/local/mysql/bin/`中有一个`mysql_secure_installation`文件，它是一个脚本，我们可以运行它来做一些自动化的安全设置，由于这个设置是存储到mysql的系统数据库中的，所以需要运行mysqld服务后才可以使用，否则报错(比如报找不到mysql.sock文件)
```bash
cd /usr/local/mysql/bin/
./mysql_secure_installation
```

以下是运行`mysql_secure_installation`后的所有设置
```bash
Securing the MySQL server deployment.

Connecting to MySQL using a blank password.

VALIDATE PASSWORD COMPONENT can be used to test passwords
and improve security. It checks the strength of password
and allows the users to set only those passwords which are
secure enough. Would you like to setup VALIDATE PASSWORD component?

Press y|Y for Yes, any other key for No: y

There are three levels of password validation policy:

LOW    Length >= 8
MEDIUM Length >= 8, numeric, mixed case, and special characters
STRONG Length >= 8, numeric, mixed case, special characters and dictionary                  file

Please enter 0 = LOW, 1 = MEDIUM and 2 = STRONG: 0
Please set the password for root here.

New password:

Re-enter new password:

Estimated strength of the password: 50
Do you wish to continue with the password provided?(Press y|Y for Yes, any other key for No) : y
By default, a MySQL installation has an anonymous user,
allowing anyone to log into MySQL without having to have
a user account created for them. This is intended only for
testing, and to make the installation go a bit smoother.
You should remove them before moving into a production
environment.

Remove anonymous users? (Press y|Y for Yes, any other key for No) : y
Success.


Normally, root should only be allowed to connect from
'localhost'. This ensures that someone cannot guess at
the root password from the network.

Disallow root login remotely? (Press y|Y for Yes, any other key for No) : y
Success.

By default, MySQL comes with a database named 'test' that
anyone can access. This is also intended only for testing,
and should be removed before moving into a production
environment.


Remove test database and access to it? (Press y|Y for Yes, any other key for No) : y
 - Dropping test database...
Success.

 - Removing privileges on test database...
Success.

Reloading the privilege tables will ensure that all changes
made so far will take effect immediately.

Reload privilege tables now? (Press y|Y for Yes, any other key for No) : y
Success.

All done!
```
