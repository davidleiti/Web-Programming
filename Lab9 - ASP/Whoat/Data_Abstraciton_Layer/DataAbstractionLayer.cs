using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using MySql.Data.MySqlClient;
using Whoat.Models;

namespace Whoat.Data_Abstraciton_Layer
{
    public class DataAbstractionLayer
    {
        private string connectionString = "server=localhost;uid=root;pwd=;database=vacations;SslMode=none";

        #region User authentication

        public int Authenticate(User u)
        {
            try
            {
                using (MySqlConnection connection = new MySqlConnection(connectionString))
                {
                    connection.Open();
                    MySqlCommand command = new MySqlCommand();
                    command.Connection = connection;
                    command.CommandText = $"SELECT * FROM Users WHERE Username = '{u.Username}' AND Password = '{u.Password}'";
                    MySqlDataReader reader = command.ExecuteReader();
                    if (reader.Read())
                    {
                        return reader.GetInt16("UserID");
                    }
                    connection.Close();
                }
            }
            catch (MySqlException exception)
            {
                Console.WriteLine(exception.Message);
            }
            return -1;
        }

        #endregion

        #region Destination operations

        public List<Destination> GetDestinations()
        {
            return GetDestinationList("SELECT * FROM Destinations");
        }

        public List<Destination> GetDestinationsFromCountry(string country, int offset)
        {
            return GetDestinationList($"SELECT * FROM Destinations WHERE Country = '{country}' ORDER BY DestinationID LIMIT 4 OFFSET {offset}");
        }

        public Destination GetDestinationById(int id)
        {
            try
            {
                using (MySqlConnection connection = new MySqlConnection(connectionString))
                {
                    connection.Open();
                    MySqlCommand command = new MySqlCommand();
                    command.Connection = connection;
                    command.CommandText = $"SELECT * FROM Destinations WHERE DestinationID = {id}";
                    MySqlDataReader reader = command.ExecuteReader();
                    if (reader.Read())
                    {
                        return new Destination
                        {
                            DestinationID = reader.GetInt16("DestinationID"),
                            Country = reader.GetString("Country"),
                            City = reader.GetString("City"),
                            Address = reader.GetString("Address"),
                            Description = reader.GetString("Description")
                        };
                    }
                    connection.Close();
                }
            }
            catch (MySqlException exception)
            {
                Console.WriteLine(exception.Message);
            }
            return null;
        }

        public void InsertDestination(Destination d)
        {
            try
            {
                using (MySqlConnection connection = new MySqlConnection(connectionString))
                {
                    connection.Open();
                    MySqlCommand command = new MySqlCommand();
                    command.Connection = connection;
                    command.CommandText = $"INSERT INTO Destinations(Country, City, Address, Description) " +
                        $"VALUES ('{d.Country}', '{d.City}', '{d.Address}', '{d.Description}')";
                    command.ExecuteNonQuery();
                    connection.Close();
                }
            }
            catch (MySqlException exception)
            {
                Console.WriteLine(exception.Message);
            }
        }

        public void UpdateDestination(Destination d)
        {
            try
            {
                using (MySqlConnection connection = new MySqlConnection(connectionString))
                {
                    connection.Open();

                    MySqlCommand command = new MySqlCommand();
                    command.Connection = connection;
                    command.CommandText = $"UPDATE Destinations SET Country = '{d.Country}', City = '{d.City}', " +
                        $"Address = '{d.Address}', Description = '{d.Description}' WHERE DestinationID = {d.DestinationID}";
                    command.ExecuteNonQuery();

                    connection.Close();
                }
            }
            catch (MySqlException ex)
            {
                Console.WriteLine(ex.Message);
            }
        }

        public void DeleteDestination(int destinationId)
        {
            try
            {
                using (MySqlConnection connection = new MySqlConnection(connectionString))
                {
                    connection.Open();
                    MySqlCommand command = new MySqlCommand();
                    command.Connection = connection;
                    command.CommandText = $"DELETE FROM Destinations WHERE DestinationID = {destinationId}";
                    command.ExecuteNonQuery();
                    connection.Close();
                }
            }
            catch (MySqlException ex)
            {
                Console.WriteLine(ex.Message);
            }
        }


        #endregion

        #region Target operations

        public List<Target> GetTargets()
        {
            return GetTargetList("SELECT * FROM Targets");
        }

        public List<Target> GetTargetsByDestinationID(int id)
        {
            return GetTargetList($"SELECT * FROM Targets WHERE DestinationID = {id}");
        }

        public Target GetTargetById(int id)
        {
            try
            {
                using (MySqlConnection connection = new MySqlConnection(connectionString))
                {
                    connection.Open();
                    MySqlCommand command = new MySqlCommand();
                    command.Connection = connection;
                    command.CommandText = $"SELECT * FROM Targets WHERE TargetID = {id}";
                    MySqlDataReader reader = command.ExecuteReader();
                    if (reader.Read())
                    {
                        return new Target
                        {
                            TargetID = reader.GetInt16("TargetID"),
                            Description = reader.GetString("Description"),
                            Price = Decimal.Parse(reader.GetString("Price")),
                            Name = reader.GetString("Name"),
                            DestinationID = Int32.Parse(reader.GetString("DestinationID"))
                        };
                    }
                    connection.Close();
                }
            }
            catch (MySqlException exception)
            {
                Console.WriteLine(exception.Message);
            }
            return null;
        }

        public void InsertTarget(Target t)
        {
            try
            {
                using (MySqlConnection connection = new MySqlConnection(connectionString))
                {
                    connection.Open();
                    MySqlCommand command = new MySqlCommand();
                    command.Connection = connection;
                    command.CommandText = $"INSERT INTO Targets(Name, Description, Price, DestinationID) " +
                        $"VALUES ('{t.Name}', '{t.Description}', {t.Price}, {t.DestinationID})";
                    command.ExecuteNonQuery();
                    connection.Close();
                }
            }
            catch (MySqlException exception)
            {
                Console.WriteLine(exception.Message);
            }
        }

        public void UpdateTarget(Target t)
        {
            try
            {
                using (MySqlConnection connection = new MySqlConnection(connectionString))
                {
                    connection.Open();

                    MySqlCommand command = new MySqlCommand();
                    command.Connection = connection;
                    command.CommandText = $"UPDATE Targets SET Name = '{t.Name}', Description = '{t.Description}', " +
                        $"Price = {t.Price}, DestinationID = {t.DestinationID} WHERE TargetID = {t.TargetID}";
                    command.ExecuteNonQuery();

                    connection.Close();
                }
            }
            catch (MySqlException ex)
            {
                Console.WriteLine(ex.Message);
            }
        }

        public void DeleteTarget(int targetID)
        {
            try
            {
                using (MySqlConnection connection = new MySqlConnection(connectionString))
                {
                    connection.Open();
                    MySqlCommand command = new MySqlCommand();
                    command.Connection = connection;
                    command.CommandText = $"DELETE FROM Targets WHERE TargetID = {targetID}";
                    command.ExecuteNonQuery();
                    connection.Close();
                }
            }
            catch (MySqlException ex)
            {
                Console.WriteLine(ex.Message);
            }
        }

        #endregion

        #region Private Methods

        private List<Destination> GetDestinationList(string queryString)
        {
            List<Destination> destinations = new List<Destination>();
            try
            {
                using (MySqlConnection connection = new MySqlConnection(connectionString))
                {
                    connection.Open();
                    MySqlCommand command = new MySqlCommand();
                    command.Connection = connection;
                    command.CommandText = queryString;
                    MySqlDataReader reader = command.ExecuteReader();
                    while (reader.Read())
                    {
                        Destination dest = new Destination
                        {
                            DestinationID = reader.GetInt16("DestinationID"),
                            Country = reader.GetString("Country"),
                            City = reader.GetString("City"),
                            Address = reader.GetString("Address"),
                            Description = reader.GetString("Description")
                        };
                        destinations.Add(dest);
                    }
                    connection.Close();
                }
            }
            catch (MySqlException exception)
            {
                Console.WriteLine(exception);
            }
            return destinations;
        }

        private List<Target> GetTargetList(string queryString)
        {
            List<Target> targets = new List<Target>();
            try
            {
                using (MySqlConnection connection = new MySqlConnection(connectionString))
                {
                    connection.Open();
                    MySqlCommand command = new MySqlCommand();
                    command.Connection = connection;
                    command.CommandText = queryString;
                    MySqlDataReader reader = command.ExecuteReader();
                    while (reader.Read())
                    {
                        Target target = new Target
                        {
                            TargetID = reader.GetInt16("TargetID"),
                            Description = reader.GetString("Description"),
                            Price = Decimal.Parse(reader.GetString("Price")),
                            Name = reader.GetString("Name"),
                            DestinationID = Int32.Parse(reader.GetString("DestinationID"))
                        };
                        targets.Add(target);
                    }
                    connection.Close();
                }
            }
            catch (MySqlException exception)
            {
                Console.WriteLine(exception);
            }
            return targets;
        }

        #endregion
    }
}