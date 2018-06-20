{::options parse_block_html="true" /}

[WIP]

## Storing code on file systems

I'd like to tell you a story.

_In the beginning there was data. A while later somebody decided to organise it into discrete units which they called files._

It's not a great story, but it is the background for this post.

#### What's a file system

If you're reading this then you probably already know what a file system is. If not, you can find out [here](https://en.wikipedia.org/wiki/File_system).

Okay great, so we have somewhere to put our data and we can assign identifiers to help find files again later. We even have a heirarchical system of folders we can use to organise our files into collections.

#### Storing code on a file system

Ultimately there's really not another way to do this. Unless you have all of a physical storage device dedicated to your program, or perhaps if you're putting programs onto a machine which no humans need to interact with directly. Any attempt to circumvent this and share a drive will result in a monolith file, within which there is a custom system for data layout. But you haven't got away from files, and you'll have created a monster.

Because people still write code (and seem set to continue for a good long while yet) we still need to store thing in a way that humans can understand.

However, there are some consequences to storing your code directly in files. Let's take a look at some of the difficulties that naturally arise from this convention.

- File change events are platform dependent, making incremental builds unreliable. See, for example, [watchexe](https://github.com/mattgreen/watchexec) for the Rust language - it's an excellent tool but without complete toolchain support its functionality has some artificial boundaries.
- Things are grouped together without due consideration. This is particularly a problem in languages like C/C++ where the developer is especially aware that everything just ends up in one place anyway so code is grouped together in whatever way seems appropriate at the time and often doesn't move as the system changes.
- As a codebase grows, common code will be used in more and more places. Because of the complexity of moving a lot of files or code around to refactor common functionality into sane libraries, it's generally left to become technical debt. The risk doesn't appear to be worth the reward, and it certainly is a thankless task, but I'm claiming the cause can be addressed.

#### So what's an alternative?

I propose that code go into a database of sorts. There are some properties that it MUST have in order to be better than the alternative. But the advantages are awesome.

Although a relational database MAY be appropriate, I believe that in order to scale to large code bases, a graph database would be best.

A description of CodeDb:
While working with code, the developer should not create a single file or folder. Instead they use the tool of their choice to create a new item - which may be a function or class or something entirely new. How this is stored is a technical detail and should not concern the developer. All data associated with an item will be made available via the database. At a minimum it must be possible to quickly understand which items an item cooperates with, what it depends on and what depends on it. The concepts of modules, components and libraries can and should be maintained because assigning names in this way is helpful to the developer. However, typical systems do not make understanding access controls especially simple. By maintaining relations and tracking access controls, CodeDb will be able to produce reports of what is available where.

Required properties:

- The storage system must make explicit its corruption risk. _For example, files stored in Git are well checked against corruption using hashes at key moments - this is the level of guarantee this system must make._
- It must be possible to view the source code WITHOUT CodeDb. _There should be no possiblity of vendor lock-in or requirement to use a particular tool to view your code._
- All the information stored by the database MUST be source controlled. _This is subtly complicated. It requires that, when source controlled, the data format should be text. However, checking in text and requiring every user to rebuild the database from that would likely be unacceptably slow._
- CodeDb must provide an API which makes it trivial for a build system to operate on the source code. Specifically, it must be possible to determine a dependency graph for the code. This must be possible not only for the entire codebase, but for building subsets identified by terms the developer understands - such as a component library. It must also be trivial and efficient for the build system to provide code from the database to the compiler, since the database is the only thing that is allowed to access the source code. _Only allowing a single source of truth for the source code is simply solid software design. Otherwise this condition is just requiring simple interop with other systems and separating concerns. This of course allows build systems other than any I choose to create._
- It must be possible to use Echelon without CodeDb. _It is the responsibility of the language to avoid any dependencies to CodeDb and to ensure that design decisions are not influenced by the requirements of CodeDb where it could be at all detrimental to the language. It is the responsiblity of build tools to support building Echelon source from files. Any dependency information must then be provided by the developer - it is unnecessary for a build tool to attempt to deduce from source code what is stored in CodeDb._
