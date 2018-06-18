using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Whoat.Models;
using Whoat.Data_Abstraciton_Layer;

namespace Whoat.Controllers
{
    public class DestinationsController : Controller
    {
        // GET: Destinations
        public ActionResult Index()
        {
            return IsValidSession();
        }

        #region Http request handlers

        [HttpGet]
        public string GetDestinations()
        {
            DataAbstractionLayer dal = new DataAbstractionLayer();
            if (Request.Params.AllKeys.Contains("DestinationID"))
            {
                bool isValidId = Int32.TryParse(Request.Params["DestinationID"], out int destinationID);
                if (isValidId)
                {
                    Destination destination = dal.GetDestinationById(destinationID);
                    if (destination != null)
                    {
                        return DestinationToHtml(destination);
                    }
                    return "<h3>No destination with the given ID...</h3>";
                }
                return "<h3>Destination ID is not valid!</h3>";
            }
            List<Destination> destinations = dal.GetDestinations();

            return DestinationsToTable(destinations);
        }

        [HttpPost]
        public string AddDestination()
        {
            DataAbstractionLayer dal = new DataAbstractionLayer();
            string country = Request.Params["Country"];
            string city = Request.Params["City"];
            string address = Request.Params["Address"];
            string desc = Request.Params["Description"];
            if (string.IsNullOrEmpty(country) || string.IsNullOrEmpty(city))
            {
                return "Some mandatory fields are missing!";
            }
            dal.InsertDestination(new Destination
            {
                Country = country,
                City = city,
                Address = address,
                Description = desc
            });
            return "Destination added successfully!";
        }

        public string DeleteDestination()
        {
            DataAbstractionLayer dal = new DataAbstractionLayer();
            bool isValidId = Int32.TryParse(Request.Params["DestinationID"], out int destinationID);
            if (isValidId)
            {
                dal.DeleteDestination(destinationID);
                return "Removal has been successful!";
            }
            return "Destination ID is not valid!";
        }

        public string UpdateDestination()
        {
            DataAbstractionLayer dal = new DataAbstractionLayer();
            bool isValidId = Int32.TryParse(Request.Params["DestinationID"], out int destinationID);
            string country = Request.Params["Country"];
            string city = Request.Params["City"];
            if (!isValidId)
            {
                return "Destination ID is not valid!";
            }
            string address = Request.Params["Address"];
            string desc = Request.Params["Description"];
            dal.UpdateDestination(new Destination
            {
                DestinationID = destinationID,
                Country = country,
                City = city,
                Address = address,
                Description = desc
            });
            return "Update has been successful!";
        }

        #endregion

        #region Private Methods

        private ActionResult IsValidSession()
        {
            if (Session["LoggedUserID"] is null)
            {
                return RedirectToAction("Index", "Login");
            }
            return View("EditDestinationsView");
        }

        private string DestinationsToTable(List<Destination> destinations)
        {
            string result = "";
            if (destinations.Count > 0)
            {
                result += "<h4>All destinations:</h4>";
                result += "<table style = 'border-collapse: collapse;'>  <col width='50'><col width='100'><col width='100'><col width='100'><col width='100'><tr> " +
                "<th style = 'border:1px solid black'>ID</th> " +
                "<th style = 'border:1px solid black'>Country</th>" +
                "<th style = 'border:1px solid black'>City</th> " +
                "<th style = 'border:1px solid black'>Address</th> " +
                "<th style = 'border:1px solid black'>Description</th></tr>";
                foreach (Destination d in destinations)
                {
                    result += "<tr>";
                    result += $"<th style = 'border:1px solid black' >{d.DestinationID}</th>";
                    result += $"<th style = 'border:1px solid black' >{d.Country}</th>";
                    result += $"<th style = 'border:1px solid black' >{d.City}</th>";
                    result += $"<th style = 'border:1px solid black' >{d.Address}</th>";
                    result += $"<th style = 'border:1px solid black' >{d.Description}</th>";
                    result += "</tr>";
                }
                result += "</table>";
            }
            else
                result += "0 results";
            return result;
        }

        private string DestinationToHtml(Destination d)
        {
            return $"<br><h3>ID: {d.DestinationID}<br>Country: {d.Country}<br>City: {d.City}<br>Address: {d.Address}<br>Description: {d.Description}<br></h3>";
        }

        #endregion
    }
}