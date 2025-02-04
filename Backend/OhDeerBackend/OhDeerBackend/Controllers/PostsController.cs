using Microsoft.AspNetCore.Mvc;
using OhDeerBackend.Model;
using System.Collections;

namespace OhDeerBackend.Controllers
{
    [ApiController]
    [Route("Posts")]
    public class PostsController : ControllerBase
    {
        private readonly ILogger<PostsController> _logger;

        public PostsController(ILogger<PostsController> logger) 
        {
            _logger = logger;
        }

        public List<Post> Posts = new List<Post>()
        {
            new Post(0, "Broken Chair", "This chair is broken, I don't want it anymore.", 6.80),
            new Post(1, "Half eaten toy", "My kid ate half of this toy and choked, I'm selling it so that I don't get reminded of his passing.", 1.40),
        };

        [HttpGet]
        [Route("GetPosts")]
        public List<Post> GetPosts()
        {
            // Pseudo Code for eventual db connection
            // return db.Posts.GetAll;

            return Posts;
        }

        [HttpGet]
        [Route("GetPost/{id}")]
        public Post GetPost(int id) 
        {
            // Pseudo Code for eventual db connection
            // Post p = db.Posts.Find(id) == null ? null : db.Posts.Find(id);
            // return p;

            Post p = Posts.Find(p => p.Id == id) != null ? Posts.Find(p => p.Id == id) : null;
            return p;
        }
    }
}
