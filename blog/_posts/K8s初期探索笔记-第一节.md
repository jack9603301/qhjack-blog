---
title: K8s初期探索笔记-第一节
tags:
  - Devops
  - 运维/OPS
  - kubernetes(k8s)
categories: Devops
comments: true
copyright_reprint: false
description: 最近在学习k8s，这是笔记
abbrlink: 3278372690
date: 2024-09-21 13:16:21
---

# k8s的组织架构

k8s一般由三个或者三个以上节点组成，它遵循集群的一般要求，并且有以下基础类型组成：

1. Master 节点

Master 是集群的控制节点，即主节点。 在Kubernetes集群中需要由一个或者一组 Master, 负责管理和控制整个集群。 Master通常占有一台独立的服务器（在高可用模式下建议使用三台或者以上的服务器），是整个集群的【大脑】，如果它发生宕机或者不可用，那么对集群中容器应用的管理都将无法实施。

在 Master 上运行着以下关键进程

- Kubernetes API Server(kube-apiserver): 提供 HTTP RESTful API接口的主要服务，是Kubernetes中对所有资源进行增、删、改、查等操作的唯一入口，也是集群控制的入口进程。
- Kubernetes Controller Manager(kube-controller-manager): Kubernetes 中所有资源对象的自动化控制中心，可以将其理解为资源对象的【大总管】
- Kubernetes Scheduler(kube-scheduler): 负责将资源调度(Pod 调度)的进程，相当于公交调度室。

另外，在Master上通常还需要部署`etcd`服务。

如果将原本部署在Master上的这些进程以`Pod`的方式部署在`Node`上，比如采用`kubedam`安装`Kubernetes`集群，那么此时`Kubernetes`集群中就没有`Master`了，因为所有节点都是`Node`。

2. Node节点

在`Kubernetes`中，除`Master`外的其他服务器被称为`Node`，`Node`在较早的一些版本也被称为`Minion`。与`Master`一样，`Node`既可以的一台物理主机，也可以是一台虚拟机。`Node`是`Kubernetes`集群的工作负载节点，每个`Node`都会被`Master`分配一些工作负载(`Docker`容器),当某个`Node`宕机时，其上的工作负载都会被`Master`自动转移到其他`Node`上。在每个`Node`上都运行着以下关键进程：

- kubelet: 负责`Pod`对应容器的创建、启停等任务，同时与`Master`密切协作，实现集群管理的基本功能
- kube-proxy: 是实现`Kubernetes Service`通讯与负载均衡机制的服务
- 容器运行时

`Node`可以在运行期间被动态增加到`Kubernetes`集群中，前提是在这个`Node`上已经正确的安装、配置和启动了上述关键进程。在默认情况下，`kubelet`会向`Master`注册自己，这也是`Kubernetes`推荐的`Node`管理方式。一旦`Node`被纳入集群管理范畴，`kubelet`进程就会定时向`Master`汇报自身的情报，例如操作系统、主机CPU和内存的使用情况，以及当前有哪些`Pod`在运行等，这样`Master`就可以获知每个`Node`的资源使用情况，并实现高效均衡的资源调度策略了，而某个`Node`在超过指定时间不上报信息时，会被`Master`判定为【失联】，该`Node`状态被标记为【NotReady】，`Master`随后会触发【故障转移】的的自动流程。

查看集群中有多少节点的命令如下：

```bash
kubectl get nodes
```

# 命名空间

命名空间是集群类里面一个重要的基础概念，它在很多情况可以实现多租户隔离，典型的一个思路是给每个租户分配一个命名空间，命名空间属于`Kubernetes`集群范畴的资源对象，在一个集群可以创建多个命名空间，每个命名空间都是独立的存在，属于不同命名空间的资源对象在逻辑上互相隔离。在每个`Kubernetes`集群安装完成且正常运行后，`Master`会自动创建两个命名空间：

- default（默认）
- kub-system(Kubernetes系统级)

用户创建的资源对象如果没有指定命名空间，则被默认都安装在`kube-system`命名空间中。我们可以通过命名空间将集群的资源对象【分配】到不同的命名空间中，形成逻辑上分组的不同项目、小组或者用户组，便于不同的分组共享整个集群的资源的同时被分别管理。当给每个租户都创建了一个命名空间来实现多租户管理的资源隔离时，还能结合`Kubernetes`的资源配额管理，限定不同租户能占用的资源，例如CPU私有量和内存使用量等

命名空间的定义如下：

```yaml
apiVersion: v1
kind: Namespace
metadata:
  name: development
```

执行以下命令来创建此定义：

```
kubectl apply -f <namespace.yaml>
```
