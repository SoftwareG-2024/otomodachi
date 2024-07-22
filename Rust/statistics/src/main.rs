use rusqlite::{params, Connection, Result};
use std::collections::HashMap;

#[derive(Debug)]
struct Expense {
    id: i32,
    date: String,
    item: i32,
    category: String,
    amount: i32,
    description: String,
}

fn main() -> Result<()> {
    let conn = Connection::open("../../data/budget.db")?;

    let mut stmt = conn.prepare("SELECT * FROM expenses")?;
    let expense_iter = stmt.query_map(params![], |row| {
        Ok(Expense {
            id: row.get(0)?,
            date: row.get(1)?,
            item: row.get(2)?,
            category: row.get(3)?,
            amount: row.get(4)?,
            description: row.get(5)?,
        })
    })?;

    let mut totals: HashMap<String, (i32, i32, i32)> = HashMap::new();
    for expense in expense_iter {
        let expense = expense.unwrap();
        let month = &expense.date[0..7]; // Extract the year and month from the date
        let entry = totals.entry(month.to_string()).or_insert((0, 0, 0));
        if expense.item == 0 {
            entry.0 += expense.amount;
        } else if expense.item == 1 {
            entry.1 += expense.amount;
        } else {
            entry.2 += expense.amount;
        }
    }

    let conn_stats = Connection::open("../../data/statistics.db")?;
    conn_stats.execute(
        "CREATE TABLE IF NOT EXISTS stats (
                  id INTEGER PRIMARY KEY,
                  month TEXT NOT NULL,
                  total INTEGER NOT NULL,
                  income INTEGER NOT NULL,
                  other INTEGER NOT NULL
                  )",
        params![],
    )?;
    for (month, (total, income, other)) in totals {
        conn_stats.execute("INSERT INTO stats (month, total, income, other) VALUES (?1, ?2, ?3, ?4)", params![month, total, income, other])?;
    }

    Ok(())
}
