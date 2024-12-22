---
title: K8s初期探索笔记-第二节
date: 2024-09-23 13:43:39
taxonomy:
    category:
        - Devops
    tag:
        - Devops
        - 运维/OPS
        - kubernetes(k8s)
hero_classes: 'text-dark title-h1h2 overlay-light hero-large parallax'
hero_image: unsplash-luca-bravo.jpg
blog_url: /blog
show_sidebar: false
show_breadcrumbs: true
show_pagination: true
---

最近在学习k8s，这是笔记

===

# kubernetes 资源类型

## Service与Pod

应用类资源主要是围绕`Service`和`Pod`两个资源类型展开的。

一般来说，`Service`指的是无状态服务，通常由对应的多个程序副本(`Pod`实例)提供，在特殊情况下也可以是有状态单实例服务，比如`MySQL`这种数据库存储服务。`Service`既可以是`TCP`服务，也可以是`UDP`服务，还可以是`SCTP`服务，对具体的应用层协议的内容并没有任何限制。SCTP(Stream Control Transmission Protocol，流控制传输协议)是一个基于IP的可靠的面向控制信令的传输层协议，在电信领域被广泛应用，可以为电信级信令提供高效、可靠的传输服务，在5G核心网中也被应用。

与我们常规理解的服务不同，Kubernetes中的`Service`具有全局唯一的虚拟`ClusterIP`地址，`Service`一旦被创建，Kubernetes就会自动为它分配一个可用的`ClusterIP`地址，而且在`Service`的整个生命周期内，它的`ClusterIP`都不会改变，客户端可以通过【虚拟IP地址+服务的端口】的形式直接访问服务，在通过部署Kubernetes集群的DNS服务，就可以实现Service Name（域名）到`ClusterIP`地址的DNS映射功能，我们只要使用服务的名称（DNS名称）即可顺利完成到目标服务的访问请求。这样，【服务发现】这个传统架构中的棘手问题首次得到完美解决。同时，凭借`ClusterIP`地址的独特设计，Kubernetes进一步实现了`Service`透明负载均衡和故障自动转移和恢复的高级特性。

通过分析、识别并建模系统中的所有服务为微服务 —— Kubernetes Service, 我们的系统最终由多个提供不同业务能力而又彼此独立的微服务单元组成，服务之间通过 TCP/IP通信，形成了强大又灵活的弹性网络，拥有强大的分布式、弹性扩展和容错能力，程序框架也变得简单和直观许多。

接下来说说与`Service`密切相关的核心资源对象 —— `Pod`。

`Pod`是Kubernetes中最重要的基础概念之一，每个`Pod`都有一个特殊的被称为【根容器】的`Pause`容器，`Pause`容器对应的镜像属于Kubernetes的一部分，除了`Pause`容器，每个`Pod`都还有一个或者多个紧密相关的用户业务容器。

为什么Kubernetes会设计出一个全新的`Pod`概念，并且`Pod`会有这样的特殊组成结构？原因如下：

1.  为多进程之间的协作提供一个抽象模型，将`Pod`作为基本的调度、复制等管理工作的最小单位，能让多个应用进程一起有效的调度和伸缩
2. `Pod`中的多个业务容器共享`Pause`容器的IP，并且共享`Pause`容器挂接的`Volume`，这样既简化了密切关联的业务容器之间的通信问题，也很好的解决了他们之间的文件共享问题。

Kubernetes 为每个`Pod`都分配了一个唯一的IP,称之为【Pod IP】，一个`Pod`中的多个容器共享Pod IP地址。Kubernetes要求底层网络支持集群中任意两个`Pod`之间的TCP/IP直接通信，这通常采用虚拟二层网络技术实施，例如Flannel、Open vSwitch等，因此我们需要记住一点：在Kubernetes中，一个`Pod`中的容器与其他主机上的`Pod`容器能够直接通信。

`Pod`其实有两种类型：普通`Pod`和静态`Pod(Static Pod)`。静态Pod比较特殊，并没有被存放在Kubernetes的`etcd`中，而是被存放在某个具体的`Node`上的一个具体文件中，并且只能在此`Node`上启动、运行。而普通`Pod`一旦被创建，就会被存放在`etcd`中，随后进程实例化成一组相关的`Docker`容器并启动。在默认情况下，当`Pod`中的某个容器停止时，Kubernetes会自动检测到这个问题并且重新启动这个`Pod`（重启`Pod`中的所有容器），如果`Pod`所在的`Node`宕机，就会将这个`Node`上所有的`Pod`都重新调度到其他节点。

下面是我们在之前的Hello, World实例里用到的myweb这个`Pod`的资源定义文件：

```yaml
apiVersion: v1
kind: Pod
metadata:
    name: myweb
    labels:
        name: myweb
spec:
    containers:
    - name: myweb
      image: kubeguide/tomcat-app:v1
      ports:
      - containerPort: 8080
```

在以上定义中，`kind`属性的值为`Pod`，表明这是一个`Pod`类型的资源对象; `metadata`里的`name`属性为`Pod`的名称，在`metadata`里还能定义资源对象的标签，这里生命`myweb`拥有一个`name=myweb`标签。在`Pod`中所包含的容器组的定义则在`spec`部分中声明，这里定义里一个名为`myweb`且对应的镜像为`kubeguide/tomcat-app:v1`的容器，并在`8080`端口（containerPort）启动容器进程。`Pod`的IP地址加上这里的容器端口组成里一个新的概念 —— Endpoint，代表此`Pod`的一个服务进程的对外通信地址。一个`Pod`也存在具有多个`Endpoint`的情况，比如当我们把`Tomcat`定义为一个`Pod`时，可以对外暴露管理端口和服务端口这两个`Endpoint`。

我们所熟悉的Docker Volume在Kubernetes也有对应的概念 —— Pod Volume, Pod Volume被定义在`Pod`中，然后被`Pod`的各个容器挂载（Mount）到自己的文件系统中。Volume简单来说就是被挂载到`Pod`容器中的文件目录。

这里顺便提一下Kubernetes中的`Event`概念，`Event`是一个事件记录，记录里事件的最早产生时间、最后重现时间、重复次数、发起者、类型，以及导致此次事件的原因等众多信息。`Event`记录通常会被关联到某个具体的资源对象上，是排查故障的重要参考信息。之前我们看到在`Node`的描述信息中包括`Event`，而在`Pod`的描述信息中同样包括`Event`，当我们发现某个`Pod`迟迟无法创建时，可以通过`kubectl describe pod xxxx`命令查看它的描述信息，以定位问题的成因。

在继续说明`Service`和`Pod`的关系之前，我们需要先理解Kubernetes中的一个重要机制 —— 标签匹配机制。
