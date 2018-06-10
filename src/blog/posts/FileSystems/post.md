{::options parse_block_html="true" /}

## Storing code on file systems

I'd like to tell you a story.

_In the beginning there was data. A while later somebody decided to organise it into discrete units which they called files._

It's not a great story, but it is the background for this post.

#### What's a file system

If you're reading this then you probably already know what a file system is. If not, you can find out [here](https://en.wikipedia.org/wiki/File_system).

Okay great, so we have somewhere to put our data and we can assign identifiers to help find files again later. We even have a heirarchical system of folders we can use to organise our files into collections.

#### Storing code on a file system

Ultimately there's really not another way to do this. Unless you have all of a physical storage device dedicated to your program, or perhaps if you're putting programs onto a machine which no humans need to interact with directly.

Because people still write code (and seem set to continue for a good long while yet) we still need to store thing in a way that humans can understand.

However, there are some consequences to storing your code directly in files. Let's take a look at some of the difficulties that naturally arise from this convention.
