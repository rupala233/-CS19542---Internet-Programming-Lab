import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;


public class BookServlet extends HttpServlet {

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        String title = request.getParameter("title");
        String author = request.getParameter("author");
        String publisher = request.getParameter("publisher");
        String edition = request.getParameter("edition");
        String price = request.getParameter("price");

        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/LibraryDB", "root", "Klefan@233");

            PreparedStatement ps = con.prepareStatement("INSERT INTO BOOK (TITLE, AUTHOR, PUBLISHER, EDITION, PRICE) VALUES (?, ?, ?, ?, ?)");
            ps.setString(1, title);
            ps.setString(2, author);
            ps.setString(3, publisher);
            ps.setString(4, edition);
            ps.setDouble(5, Double.parseDouble(price));

            int result = ps.executeUpdate();
            if (result > 0) {
                out.println("Book added successfully.");
            } else {
                out.println("Error adding the book.");
            }
            con.close();
        } catch (Exception e) {
            e.printStackTrace();
            out.println("Error: " + e.getMessage());
        }
    }
}

