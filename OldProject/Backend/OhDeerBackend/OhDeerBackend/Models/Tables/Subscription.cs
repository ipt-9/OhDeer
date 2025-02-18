using OhDeerBackend.Models.Base_Classes;
using System.ComponentModel.DataAnnotations;

namespace OhDeerBackend.Models.Tables
{
    public class Subscription : BaseEntity
    {
        [Required, MaxLength(50)]
        public string SubscriptionName { get; set; }

        public virtual ICollection<User> Users { get; set; } = new List<User>();
    }

}
