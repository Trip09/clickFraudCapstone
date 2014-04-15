import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
 
class Main {
 
//    private static final String url = "jdbc:mysql://149.166.29.173:3306/click_fraud";
// 
//    private static final String user = "bitnami";
// 
//    private static final String password = "click_fraud";
 
    public static void main(String args[]) {
    	try {
    	    System.out.println("Loading driver...");
    	    Class.forName("com.mysql.jdbc.Driver");
    	    System.out.println("Driver loaded!");
    	} catch (ClassNotFoundException e) {
    	    throw new RuntimeException("Cannot find the driver in the classpath!", e);
    	}
    	
    	String url = "jdbc:mysql://149.166.29.173:3306/click_fraud";
    	String username = "bitnami";
    	String password = "click_fraud";
    	Connection connection = null;
    	try {
    	    System.out.println("Connecting database...");
    	    connection = DriverManager.getConnection(url, username, password);
    	    System.out.println("Database connected!");
    	} catch (SQLException e) {
    	    throw new RuntimeException("Cannot connect the database!", e);
    	} finally {
    	    System.out.println("Closing the connection.");
    	    if (connection != null) try { connection.close(); } catch (SQLException ignore) {}
    	}
    	
    }
}