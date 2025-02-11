using OhDeerBackend.Models.Base_Classes;
using System.ComponentModel.DataAnnotations;

namespace OhDeerBackend.Models
{
    public class Fee : BaseEntity
    {
        public bool IsPaid { get; set; }

        [Required]
        public DateTime DueDate { get; set; }

        [Required]
        public int Amount { get; set; }

        // Navigation Properties
        public virtual ICollection<Purchase> Purchases { get; set; } = new List<Purchase>();
    }

}
