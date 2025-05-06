using OhDeerBackend.Models.Base_Classes;
using System.ComponentModel.DataAnnotations;

namespace OhDeerBackend.Models.Tables
{
    public class UserType : BaseEntity
    {
        [Required, MaxLength(50)]
        public string UserTypeName { get; set; }

        public virtual ICollection<User> Users { get; set; } = new List<User>();
    }
}
