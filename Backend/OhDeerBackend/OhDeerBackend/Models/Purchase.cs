using System.ComponentModel.DataAnnotations.Schema;
using System.ComponentModel.DataAnnotations;
using OhDeerBackend.Models.Base_Classes;

namespace OhDeerBackend.Models
{
    public class Purchase : BaseEntity
    {
        [Required]
        public int Amount { get; set; }

        [Required]
        public TimeSpan Timestamp { get; set; }

        [Required]
        public DateTime Date { get; set; }

        public bool IsOutstanding { get; set; }

        public int RepairRating { get; set; }
        public int GeneralRating { get; set; }

        public string? RatingComment { get; set; }

        // Foreign Keys
        [Required]
        public int PostId { get; set; }
        public virtual Post Post { get; set; }

        [Required]
        public int UserId { get; set; }
        public virtual User User { get; set; }

        [Required]
        public int FeeId { get; set; }
        public virtual Fee Fee { get; set; }
    }

}
