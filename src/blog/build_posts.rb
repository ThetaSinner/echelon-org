require 'kramdown'
require 'mustache'
require 'yaml'
require 'fileutils'

class Post < Mustache	
	def initialize(name, title)
		@title = title
		@markdownPath = "./posts/#{name}/post.md"
	end
	
	def title
		@title
	end
	
	def content
		Kramdown::Document.new(File.read(@markdownPath)).to_html
	end
end

class Nav < Mustache
	def initialize(posts)
		@posts = posts
	end

	def posts
		@posts
	end
end

def renderPost(postConfig)
	thePost = Post.new(postConfig['name'], postConfig['title'])
	thePost.render
end

# Load the configuration.
postsConfig = YAML.load_file('posts-config.yaml')

outputPath = postsConfig['outputPath']
postList = Array.new
postsConfig['posts'].each do |post|
	# Render the post by compiling the markdown and injecting it into the template.
	thePost = renderPost(post)
	
	# Create the output directory for this post
	postName = post['name']
	postPath = "#{outputPath}/#{postName}"
	FileUtils.mkdir_p postPath
	
	# Write the post to file.
	File.open("#{postPath}/post.php", 'w') { |file| file.write(thePost) }
	
	# Save the post name for the nav.
	postList.push Hash["name" => postName]
end

theNav = Nav.new(postList).render
File.open("#{outputPath}/post-nav.php", 'w') { |file| file.write(theNav) }

