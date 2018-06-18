using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Whoat.Models
{
    public class Target
    {
        public int TargetID { get; set; }
        public string Name { get; set; }
        public string Description { get; set; }
        public decimal Price { get; set; }
        public int DestinationID { get; set; }

    }
}