using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace OhDeerBackend.Migrations
{
    /// <inheritdoc />
    public partial class ToTestMigration : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.RenameColumn(
                name: "UserId",
                table: "Users",
                newName: "UserIds");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.RenameColumn(
                name: "UserIds",
                table: "Users",
                newName: "UserId");
        }
    }
}
