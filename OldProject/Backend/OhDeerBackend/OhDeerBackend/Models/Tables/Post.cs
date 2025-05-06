using System.ComponentModel.DataAnnotations.Schema;
using System.ComponentModel.DataAnnotations;
using OhDeerBackend.Models.Base_Classes;

namespace OhDeerBackend.Models.Tables
{
    public class Post : BaseEntity
    {
        [Required, MaxLength(100)]
        public string Title { get; set; }

        [Required, MaxLength(500)]
        public string Description { get; set; }

        [Required]
        public int Price { get; set; }

        public bool IsRepair { get; set; }
        public bool IsComplete { get; set; }

        // Foreign Keys
        [Required]
        public int CategoryId { get; set; }
        public virtual Category Category { get; set; }

        [Required]
        public int CustomerId { get; set; }
        public virtual User Customer { get; set; }

        // Navigation Properties
        public virtual ICollection<Purchase> Purchases { get; set; } = new List<Purchase>();
    }

}
