---
title: K8s初期探索笔记-第三节
tags:
  - Devops
  - 运维/OPS
  - kubernetes(k8s)
categories: Devops
comments: true
copyright_reprint: false
description: 最近在学习k8s，这是笔记
abbrlink: 3194990808
date: 2024-10-20 17:16:00
---

# 了解Kubernetes应用

## `Label`和`Label Selector`

`Label`是`Kubernetes`系统中的另一个核心概念，相当于我们熟悉的标签。一个`Label`是一个`key=value`的键值对，其中的`key`与`value`由用户自己指定。`Label`可以被附加到各种资源对象上，例如`Node`、`Pod`、`Service`、`Volume`、`Deployment`等。一个资源对象可以定义任意数量的`Label`，同一个`Label`也可以被添加到任意数量的资源对象上。`Label`通常在定义资源对象时确定，也可以在对象创建后动态的添加或者删除。我们可以通过给指定的资源对象捆绑一个或者多个不同的`Label`来实现多维度的资源对象分组管理功能，以便灵活、方便地进行资源分配、查询管理、调度、配置、部署等，例如，部署不同版本的应用到不同的环境下，以便监控、分析应用（日志记录、监控、告警）等。一些常见的`Label`示例如下。

- 版本`Label`: `release: stable`和`release: canary`
- 环境`Label`: `environment: dev`、`environment: qa`和`environment: production`
- 架构`Label`: `tier: frontend`、`tier: backend`和`tier: middleware`
- 分区`Label`: `partition: customerA`和`partition: customerB`
- 质量管控`Label`: `track: daily`和`track: weekly`

给某个资源定义`Label`，就相当于给它打了一个标签，随后可以通过`Label Selector`(标签选择器)查询和筛选拥有某些`Label`的资源对象，`Kubernetes`通过这种方式实现了类似SQL的简单而又通用的对象查询机制。`Label Selector`可以被类比为SQL语句中的where查询条件，例如，`name: redis-salve`这个`Label Selector`在作用于`Pod`时，可以被类比为`select * from pod where pod's name = 'redis-salve'`语句。当前有两种`Label Selector`表达式：

1. 基于等式的`Label Selector`表达式
2. 基于集合的`Label Selector`表达式

基于等式的`Label Selector`表达式采用等式类表达式匹配`Label`，下面是一些具体的实例：

- `name = redis-salve`: 匹配所有具有`name=redis-slave` Label的资源对象
- `env != production`:  匹配所有不具有`env=production` Label的资源对象，比如 `env = test` 就是满足此条件的`Label`之一

基于集合的`Label Selector`表达式则采用集合操作类表达式匹配`Label`，下面是一些具体的示例。

- `name in ( redis-master, redis-salve)`: 匹配所有具有`name=redis-master` Label或`name=redis-salve` Label资源对象
- `name not in ( php-frontend)`: 匹配所有不具有`name=php-frontend` Label资源对象

我们可以通过多个`Label Selector`表达式组合来实现复杂的条件选择，在多个表达式之间用`,`进行分割即可，几个条件之间是AND的关系，即同时满足多个条件，比如下面的示例：

```
name=redis-slave,env!=production
name notin (php-frontend),env!=production
```

在前面的【Hello,world】示例中只用了一个`name=XXX`的`Label Selector`,来看一个更复杂的示例：假设一个Pod定义了3个Label: release、env和role,不同的Pod定义了不同的Label值，如果设置`role=frontend`是Label Selector,则会选取`Node1`和`Node2`上的Pod;如果设置`release=beta`的Label Selector，则会选取Node2和Node3上的Pod。

总之，使用Label可以给对象创建多组标签，Label和Label Selector共同构成了Kubernetes系统中核心的应用模型，可被管理对象精细的分组管理，同时实现了整个集群的高可用性。

Label也是Pod的重要属性之一，其重要性仅次于Pod的端口，在实际生产环境下，我们几乎看不到没有Label的Pod,以myweb Pod为例，下面给它设定了`app=myweb` Label:

```yaml
apiVersion: v1
kind: Pod
metadata:
  name: myweb
  labels:
    app: myweb
```

对应的Service myweb就是通过下面的Label Selector与myweb Pod发生关联的：

```yaml
spec:
  selector:
    app: myweb
```

所以我们看到，Service很重要的一个属性就是Label Selector,如果我们不小心把Label写错了，就会出现指鹿为马的闹。如果恰好匹配到了另一个Pod实例。而且对应的容器端口恰好正确，服务可以正常连接，则很难排查问题，特别是在有众多Service的复杂系统中
