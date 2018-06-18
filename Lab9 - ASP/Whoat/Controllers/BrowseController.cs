using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Whoat.Data_Abstraciton_Layer;
using Whoat.Models;

namespace Whoat.Controllers
{
    public class BrowseController : Controller
    {
        // GET: Browse
        [HttpGet]
        public ActionResult Index(string country, int offset)
        {
            if (Session["LoggedUserID"] != null)
            {
                return RedirectToAction("LoadCurrentDestinations", new { c = country, o = offset });
            }
            return RedirectToAction("Index", "Login");
        }

        public ActionResult LoadCurrentDestinations(string c, int o)
        {
            if (Session["LoggedUserID"] is null)
            {
                return RedirectToAction("Index", "Login");
            }
            DataAbstractionLayer dal = new DataAbstractionLayer();
            Console.Write(Request.Form);
            List<Destination> destinations = dal.GetDestinationsFromCountry(c, o);
            ViewData["CurrentDestinations"] = destinations;
            ViewData["Country"] = c;
            ViewData["Offset"] = o;
            return View("BrowseView");
        }
    }
}