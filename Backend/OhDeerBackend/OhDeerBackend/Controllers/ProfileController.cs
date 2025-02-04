using Microsoft.AspNetCore.Mvc;
using OhDeerBackend.Model;
using System.Reflection;

namespace OhDeerBackend.Controllers
{
    [ApiController]
    [Route("Profiles")]
    public class ProfileController : Controller
    {
        private readonly ILogger<ProfileController> _logger;

        public ProfileController(ILogger<ProfileController> logger)
        {
            _logger = logger;
        }

        // To be deleted after db connection
        List<Profile> Profiles = new List<Profile>()
        {
            new Profile(0, "yuyu", "aflsdhfqaj", "it", DateTime.Now, false),
            new Profile(1, "roman.k", "aoiuhnciugv", "en", DateTime.Now, false),
            new Profile(2, "Aequillus", "bcxvoiutre", "en", DateTime.Now, false),
        };

        [HttpGet]
        [Route("GetProfile/{id}")]
        public Profile GetProfile(int id)
        {
            // Pseudo Code for eventual db connection
            // Profile p = db.Profiles.Find(id) == null ? null : db.Profiles.Find(id);
            // return p;

            Profile p = Profiles.Find(p => p.Id == id) != null ? Profiles.Find(p => p.Id == id) : null;
            return p;
        }

        // TODO: Adapt with db Connection, for now just removes from the list temporarily
        [HttpDelete]
        [Route("DeleteProfile/{id}")]
        public List<Profile> DeleteProfile(int id)
        {   
            Profile p = GetProfile(id);

            if (p != null)
            {
                Profiles.Remove(p);

                return Profiles;
            }

            return null;
        }
    }
}
