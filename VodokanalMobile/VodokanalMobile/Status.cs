using System;
using System.Collections.Generic;
using System.Text;
using SQLite;

namespace VodokanalMobile
{
    [Table ("Status")]
    public class Status
    {
        [PrimaryKey, AutoIncrement, Column("_id")]
        public int Id_status { get; set; }
        public string Name_status { get; set; }
    }
}
