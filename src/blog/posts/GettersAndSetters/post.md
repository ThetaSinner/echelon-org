## Getters and Setters

This is an interesting topic. Public accessors to private fields, is essentially punching holes in encapsulation. At least when they're over used.

The first thing I decided to do was see what's already been said. In my opinion, there is an intelligent argument against getters and setters here [Why getters and setters are evil](https://www.javaworld.com/article/2073723/core-java/why-getter-and-setter-methods-are-evil.html). It's an old article but, given how many current articles reference it, very relevant.

Although this thinking, and OO programming, has been around for a long time this detail doesn't seem to have been truly appreciated. This [article](http://www.yegor256.com/2014/09/16/getters-and-setters-are-evil.html) references the previous one. The idea that getters and setters break encapsulation has been understood. Also the idea that OO systems should be designed as such and not be treated as procedural with objects. However, it doesn't go deep enough. It's not just about naming methods sensibly so that communication becomes about modelled actions rather than standard names.

In my experience of Java developers, getters and setters are a big part of their programs. So perhaps any OO developer who is considering better designed system can be forgiven for not going far enough. It's also going to be difficult for a developer who does understand the problem to convert a system which hasn't been well designed. 

Consider an application with a very large data model. To aid the discussion, let's take an advertising platform. The data model will be a user profile, for targetting adverts against. If this data model has been written with getters and setters then the system around it is going to have problems too. When a user interacts with an advert in a positive way then the system much consider how this changes the model. How should this be different?

Well, the concept of a data model needs to die right off the bat. Instead we have a system of objects representing a user's profile. This system will store any data it needs to, but it's not there to store data. Instead, it's there to *be* a user's profile. Now in our scenario, the system is provided with the information that the user interacted with an advert. As well as any information that it needs about the advert in order to progress its interal representation.

Of course, it will still be possible to get data out of this sytem. Perhaps a set of possible adverts could be provided to it, and it will respond with the best advert to display. Hopefully it's clear that this is very different to using getters to fetch the interal data from the user profile system and making a decision about which advert to display based on that data.

Where I want to take this discussion though is how this can be achieved in real systems. A real enterprise system of significant size which has proceeded with a design that involves much poorly encapsulated data is going to be very hard to change. Refactoring is risky, that's relatively uncontentious. If you're thinking, that you could mix in some improvements you might be right. However, consider a data model which is generated from an XSD or similar. You can't add logic to, or build a system of any kind other than pure data model, if the code is generated. This is not an abstract idea, this is something I've seen more than once.

How about new code then? Well, if you have the time to spend before you start writing code then of course the system can be better designed. Particularly if it's an application, rather than a library or infrastucture, then likely cost/profit is going to be a factor. That's really another discussion though, as to how good the design needs to be.

So a a careful design has been created and the coding begins. If all goes according to plan then the new program has excellent encapsulation and probably quite high code quality and consistent naming and style. This is a good position to be in, but now more requirements arrive. That's fine, we'll assume management are happy after a successful start, and the developers are given the time to sit down and work out how the system needs to change to include the new requirement.

On and on the process goes. But now one or more of many things is likely going to happen.
- New developers are going to join the project. The don't know the system, regardless of good intentions.
- The system will grow very large, and over time knowledge of some areas will be lost.
- Customer focus will naturally reduce the amount of time available for careful planning or designs.
- Bug fixes and performance improvements will take their toll on the code's quality

And I'm sure there are more things I haven't thought of right now.

So what how can this issue be addressed? Because the articles I've referenced propose a different way of designing and writing code. I've pointed out some of the issues I see in achieving this practically. What's needed though, is some ideas for how the situation can be improved.
