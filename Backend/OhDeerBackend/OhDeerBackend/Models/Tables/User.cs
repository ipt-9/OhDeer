using System.ComponentModel.DataAnnotations.Schema;
using System.ComponentModel.DataAnnotations;
using OhDeerBackend.Models.Base_Classes;

namespace OhDeerBackend.Models.Tables
{
    public class User : BaseEntity
    {
        [Required, MaxLength(50)]
        public string Username { get; set; }

        [Required]
        public string PasswordHash { get; set; }

        [Required]
        public string HashSalt { get; set; }

        [Required, EmailAddress]
        public string Email { get; set; }

        public int RepairRating { get; set; }
        public int GeneralRating { get; set; }

        [Required, MaxLength(100)]
        public string Address { get; set; }

        [Required]
        public int PhoneNumber { get; set; }

        [Required, MaxLength(34)] // IBAN length
        public string IBAN { get; set; }

        // Foreign Keys
        [Required]
        public int UserTypeId { get; set; }
        public virtual UserType UserType { get; set; }

        [Required]
        public int LanguageId { get; set; }
        public virtual Language Language { get; set; }

        [Required]
        public int SubscriptionId { get; set; }
        public virtual Subscription Subscription { get; set; }

        // Navigation Properties
        public virtual ICollection<Post> Posts { get; set; } = new List<Post>();
        public virtual ICollection<Purchase> Purchases { get; set; } = new List<Purchase>();
    }

}
