{::options parse_block_html="true" /}

## Getters and Setters

This is an interesting topic. Public accessors to private fields, is essentially punching holes in encapsulation. Especially when they're over used.

The first thing I decided to do was see what's already been said. In my opinion, there is an intelligent argument against getters and setters here [Why getters and setters are evil](https://www.javaworld.com/article/2073723/core-java/why-getter-and-setter-methods-are-evil.html). It's an old article but, given how many current articles reference it, still relevant.

This thinking, and OO programming, have been around for a long time. Sadly, this detail doesn't seem to have been truly appreciated. This [article](http://www.yegor256.com/2014/09/16/getters-and-setters-are-evil.html) references the previous one. The idea that getters and setters break encapsulation has been understood. Also the idea that OO systems should be designed as such and not be treated as procedural with objects. However, it doesn't go deep enough. It's not just about naming methods sensibly so that communication becomes about modelled actions rather than standard names.

In my experience of Java developers, getters and setters are a big part of their programs. So perhaps any OO developer who is considering better designed system can be forgiven for not going far enough. 

It's also going to be difficult for a developer who does understand the problem to convert a system which hasn't been well designed. To imagine why that might be the case, let's make up a case study.

#### Advertising platform case study
<div class="border-left border-primary px-5">
Consider an application with a very large data model. To aid the discussion, let's take an advertising platform. The data model will be a user profile, for targetting adverts at. If this data model has been written with getters and setters then the system around it is going to have problems too. When a user interacts with an advert in a positive way then the system must consider how this changes the model. How should this be different?

Well, the concept of a data model needs to die right off the bat. Instead we have a system of objects representing a user's profile. This system will store any data it needs to, but it's not there to store data. Instead, it's there to *be* a user's profile. Now in our scenario, the system is provided with the information that the user interacted with an advert. As well as any information that it needs about the advert in order to progress its interal representation. The details might involve a User class receiving input, changing its internal representation by talking to an advertising ML algorithm which is represented by its own system of objects.

Of course, it will still be possible to get data out of this sytem. Perhaps a set of potential adverts could be provided to it, and it will respond with the best advert to display. Hopefully it's clear that this is very different to using getters to fetch the interal data from the user profile system and making a decision about which advert to display based on that data.
</div>

Where I want to take this discussion though, is how this can be achieved in real systems. A real enterprise system of significant size which has proceeded with a design that involves much poorly encapsulated data is going to be very hard to change. Refactoring is risky, that's relatively uncontentious. If you're thinking, that you could mix in some improvements you might be right. However, consider a data model which is generated from an XSD or similar. You can't add logic to, or deviate in any way from, a pure data model if the code is generated. This is not an abstract idea, this is something I've seen (more than once).

In some cases it might be best to stick to the patterns which are already established. Or maybe the codebase has little inactive code and can be transitioned over time. These are decisions to be made case-by-case.

How about new code then? Well, if you have the time to spend before you start writing code then of course the system can be well designed.
Unfortunately if it's an application, rather than a library or infrastucture, then likely cost/profit is going to be a factor. Though this is true for any project. There's almost always a time factor. Technology moves fast and long running projects are likely to date before they become popular. This is really another discussion though.

So a carefully considered design has been created and the coding begins. If all goes according to plan then the new program has excellent encapsulation and probably quite high code quality and consistent naming and style. This is a good position to be in, but now more requirements arrive. That's fine, we'll assume management are happy after a successful start, and the developers are given the time to sit down and work out how the system needs to change to accomodate the new requirement.

On and on the process goes. But now one or more of many things is happens.
- New developers join the project. The don't know the system, regardless of good intentions.
- The system will grow very large, and over time knowledge of some areas will be lost.
- Customer focus will naturally reduce the amount of time available for careful planning or designs. Read *maintenance*.
- Bug fixes and performance improvements will take their toll on the code's quality.

And I'm sure there are more things I haven't mentioned here.

So how can this issue be addressed? Because the articles I've referenced propose a different way of designing and writing code. I've pointed out some of the issues I see in achieving this practically. What's needed though, are ideas for how the situation can be improved.

#### Coupled Clusters
This is not a term which currently means anything (in computer science). I am using it because it is hopefully descriptive of this suggestion.

The idea is to build higher order structure into an OO language. This would allow the developer to describe a set of classes which are related. Within the set, good practises should still be followed. 
The difference is that what's encapsulated inside the set is different to what's encapsulated from outside. The ability of a class *inside* the set to access a method on another class inside the set has no relation to the ability of a class *outside* the set to access the same method.

This is somthing which Java *almost* has. By using packages and the different levels of privacy, somthing like what I'm describing can be achieved. However, a couple problems with the Java package approach

- It's tied to the file system, so packages end up deeply nested very quickly. It also means moving files as the system changes, which isn't ideal with source control.
- There's no way (using only packages) to hide the classes which have methods that make up the API to the package. You are forced to export a class with most of its implementation private and a few bits public.

Most of the languges I've come across which have modules/packages are a little less expressive than Java in this regard. But there are some general solutions to this.

1. Make everything inside your module private, then create a single public class which exposes the module's API. Please don't overuse this!
2. A good solution, in as much as it's common, is to create seperately compiled components. For example in a Java service you might see the database component seperated out. This allows the database implementation to be hidden behind an API with no risk of leakage caused by public methods inside the implementation. That is, when correctly implemented. You do not get this for free, some work is required to make this solid.

A better solution, is to make this part of the language. Remove the dependency on the file system, hide the classes which make up the module and also remove the overhead of defining redundant classes and project builds.

N.B. The Java langauge designers appear to be at least somewhat aware of these 'limitations' of packages. Changes are appearing in Java 9, and maybe there'll be more in the next version?

#### Grapical tools
Simply, visualise the dependencies in a system. Similarly to the way [SonarQube](https://www.sonarqube.org/) identifies and assigns new issues, adding new coupling could be tracked and visualised. Perhaps a drill-down graph which can display the coupling at multiple levels using thicker and thinner edges to describe coupling between components.
Using a period of time, such as an agile sprint, a difference could be displayed. Perhaps by using colouring, or labeling.

This only helps developers understand how the changes they're making affect coupling. It doesn't help them avoid writing problematic code. Fixing issues later is opt-in. Of course that doesn't make it not worth having, it just means that developers must choose to write better code.
