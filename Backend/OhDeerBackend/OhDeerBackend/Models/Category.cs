using OhDeerBackend.Models.Base_Classes;
using System.ComponentModel.DataAnnotations;

namespace OhDeerBackend.Models
{
    public class Category : BaseEntity
    {
        [Required, MaxLength(100)]
        public string CategoryName { get; set; }

        public virtual ICollection<Post> Posts { get; set; } = new List<Post>();
    }

}
