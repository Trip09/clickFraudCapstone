import java.sql.*;


/* DatabaseWrapper
 * Database interface for MySQL, using JDBC.
 * 
 * Connection() - Sets up connection to the database, returns error otherwise.
 */
public class DatabaseWrapper {
	   // Database location & JBDC Driver Location
	   static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
	   static final String DB_URL = "jdbc:mysql://localhost/EMP";
	   	   
	   //  Database credentials
	   static final String USER = "username";
	   static final String PASS = "password";
	
	/* Open()
	 * Open a connection to the database
	 */
	public void Open(){
	  Connection conn = null;
	  Statement stmt = null;
		   
	  try {
	      // Register JDBC driver
	      Class.forName("com.mysql.jdbc.Driver");
		  System.out.println("Connecting to database...");
	      conn = DriverManager.getConnection(DB_URL,USER,PASS);
	      
	  } catch(SQLException se) {
		  // Handle SQL Exceptions
	  } catch(Exception e){
		  // Other
	  }
	}//end method Open()

	/* Close()
	 * Closes database connection
	 */
	public void Close(){
	}

	/* Query()
	 * Queries the database, returns data (weka formmated?)
	 */
	public void Query(){
	}
	
}//end class DatabaseWrapper()

