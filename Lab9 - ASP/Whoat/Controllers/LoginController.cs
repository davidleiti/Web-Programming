using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Whoat.Models;
using Whoat.Data_Abstraciton_Layer;

namespace Whoat.Controllers
{
    public class LoginController : Controller
    {
        // GET: Login
        public ActionResult Index()
        {
            return View("LoginView");
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Login(User u)
        {
            if (ModelState.IsValid)
            {
                DataAbstractionLayer dal = new DataAbstractionLayer();
                int authenticatedUserId = dal.Authenticate(u);
                if (authenticatedUserId != -1)
                {
                    Session["LoggedUserID"] = authenticatedUserId;
                    return RedirectToAction("Index", "Main");
                }
            }
            return View("LoginFailedView");
        }

        public ActionResult LoginFailed()
        {
            return View("LoginFailedView");
        }

        public ActionResult AfterLogin()
        {
            Console.WriteLine("After login");
            if (Session["LoggedUserID"] != null)
            {
                return View("MainView");
            }
            return RedirectToAction("Index");
        }
    }
}