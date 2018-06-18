using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Whoat.Controllers
{
    public class MainController : Controller
    {
        // GET: Main
        public ActionResult Index()
        {
            if (Session["LoggedUserID"] != null)
                return View("MainView");
            return RedirectToAction("LoginFailed", "Login");
        }
    }
}