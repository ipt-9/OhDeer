namespace OhDeerBackend.Model
{
    public class Post
    {
       public int Id { get; set; }
        public string Title { get; set; }
        public string Description { get; set; }
        public double Price { get; set; }

        public Post(int id, string title, string description, double price)
        {
            Id = id;
            Title = title;
            Description = description;
            Price = price;
        }
    }
}
