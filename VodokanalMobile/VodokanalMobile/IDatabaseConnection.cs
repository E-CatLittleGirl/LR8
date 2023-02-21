using System;
using System.Collections.Generic;
using System.Text;
using SQLite;

namespace VodokanalMobile
{
    public interface IDatabaseConnection
    {
        SQLite.SQLiteConnection DbConnection();
    }
}
