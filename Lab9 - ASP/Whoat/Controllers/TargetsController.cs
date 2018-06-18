using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Whoat.Data_Abstraciton_Layer;
using Whoat.Models;

namespace Whoat.Controllers
{
    public class TargetsController : Controller
    {
        // GET: Targets
        public ActionResult Index()
        {
            return IsValidSession();
        }

        #region Http Request Handlers

        [HttpGet]
        public string GetTargets()
        {
            DataAbstractionLayer dal = new DataAbstractionLayer();
            if (Request.Params.AllKeys.Contains("TargetID"))
            {
                bool isValidId = Int32.TryParse(Request.Params["TargetID"], out int targetID);
                if (isValidId)
                {
                    Target target = dal.GetTargetById(targetID);
                    if (target != null)
                    {
                        return TargetToHtml(target);
                    }
                    return "<h3>No target with the given ID...</h3>";
                }
                return "<h3>Target ID is not valid!</h3>";
            }
            List<Target> targets = dal.GetTargets();

            return TargetsToTable(targets);
        }

        [HttpPost]
        public string AddTarget()
        {
            DataAbstractionLayer dal = new DataAbstractionLayer();
            string name = Request.Params["Name"];
            string desc = Request.Params["Description"];
            bool isValidPrice = Decimal.TryParse(Request.Params["Price"], out decimal price);
            bool isValidDestId = Int32.TryParse(Request.Params["DestinationID"], out int destinationId);
            if (isValidDestId && isValidPrice && !string.IsNullOrEmpty(name))
            {
                dal.InsertTarget(new Target
                {
                    Name = name,
                    Description = desc,
                    Price = price,
                    DestinationID = destinationId
                });
                return "Target added successfully!";
            }
            return "Some field(s) have invalid values, please fix before proceeding.";
        }

        public string DeleteTarget()
        {
            DataAbstractionLayer dal = new DataAbstractionLayer();
            bool isValidId = Int32.TryParse(Request.Params["TargetID"], out int targetID);
            if (isValidId)
            {
                dal.DeleteTarget(targetID);
                return "Removal has been successful!";
            }
            return "Target ID is not valid!";
        }

        public string UpdateTarget()
        {
            DataAbstractionLayer dal = new DataAbstractionLayer();
            string name = Request.Params["Name"];
            string desc = Request.Params["Description"];
            bool isValidId = Int32.TryParse(Request.Params["TargetID"], out int targetID);
            bool isValidPrice = Decimal.TryParse(Request.Params["Price"], out decimal price);
            bool isValidDestId = Int32.TryParse(Request.Params["DestinationID"], out int destinationId);
            if (isValidId && isValidPrice && isValidDestId && !string.IsNullOrEmpty(name))
            {
                dal.UpdateTarget(new Target
                {
                    TargetID = targetID,
                    Name = name,
                    Description = desc,
                    Price = price,
                    DestinationID = destinationId
                });
                return "Target updated successfully!";
            }
            return "Some field(s) have invalid values, please fix before proceeding.";
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

        private string TargetsToTable(List<Target> targets)
        {
            string result = "";
            if (targets.Count > 0)
            {
                result += "<h4>All targets:</h4>";
                result += "<table style = 'border-collapse: collapse;'>  <col width='50'><col width='100'><col width='100'><col width='100'><col width='100'><tr> " +
                "<th style = 'border:1px solid black'>ID</th> " +
                "<th style = 'border:1px solid black'>Name</th>" +
                "<th style = 'border:1px solid black'>Description</th> " +
                "<th style = 'border:1px solid black'>Price</th> " +
                "<th style = 'border:1px solid black'>DestinationID</th></tr>";
                foreach (Target t in targets)
                {
                    result += "<tr>";
                    result += $"<th style = 'border:1px solid black' >{t.TargetID}</th>";
                    result += $"<th style = 'border:1px solid black' >{t.Name}</th>";
                    result += $"<th style = 'border:1px solid black' >{t.Description}</th>";
                    result += $"<th style = 'border:1px solid black' >{t.Price}</th>";
                    result += $"<th style = 'border:1px solid black' >{t.DestinationID}</th>";
                    result += "</tr>";
                }
                result += "</table>";
            }
            else
                result += "0 results";
            return result;
        }

        private string TargetToHtml(Target t)
        {
            return $"ID: {t.TargetID}<br>Name: {t.Name}<br>Description: {t.Description}<br>Price: {t.Price}<br>DestinationID: {t.DestinationID}<br>";
        }

        #endregion
    }
}