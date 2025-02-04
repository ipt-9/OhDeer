namespace OhDeerBackend.Model
{
    public class Profile
    {
        public int Id { get; set; }
        public string Username { get; set; }
        public string PasswordHash { get; set; }
        public string PrefLanguage { get; set; }
        public DateTime AccountCreation { get; set; }
        // Just For testing
        public bool IsVerified { get; set; }

        public Profile(int id, string username, string passwordHash, string prefLanguage, DateTime accountCreation, bool isVerified)
        {
            Id = id;
            Username = username;
            PasswordHash = passwordHash;
            PrefLanguage = prefLanguage;
            AccountCreation = accountCreation;
            IsVerified = isVerified;
        }
    }
}
