using Microsoft.EntityFrameworkCore;
using OhDeerBackend.Models.Tables;

public class ApplicationDbContext : DbContext
{
    public ApplicationDbContext(DbContextOptions<ApplicationDbContext> options)
        : base(options) { }

    public DbSet<User> Users { get; set; }
    public DbSet<Post> Posts { get; set; }
    public DbSet<Purchase> Purchases { get; set; }
    public DbSet<Category> Categories { get; set; }
    public DbSet<Fee> Fees { get; set; }

    protected override void OnModelCreating(ModelBuilder modelBuilder)
    {
        modelBuilder.Entity<User>().Property(u => u.Id).HasColumnName("UserIds");
        modelBuilder.Entity<Post>().Property(p => p.Id).HasColumnName("PostId");
        modelBuilder.Entity<Purchase>().Property(p => p.Id).HasColumnName("PurchaseId");
        modelBuilder.Entity<Category>().Property(c => c.Id).HasColumnName("CategoryId");
        modelBuilder.Entity<Fee>().Property(f => f.Id).HasColumnName("FeeId");

        base.OnModelCreating(modelBuilder);
    }
}
