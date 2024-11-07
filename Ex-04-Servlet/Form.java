

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Form
 */
@WebServlet("/Form")
public class Form extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Form() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
		response.setContentType("text/html");
		PrintWriter out = response.getWriter();
		out.println("<h3> Thanks for submiting the form.Here are your details: </h3>");
		String name = request.getParameter("name");
		out.println("<h2> Student Name: " + name + "</h2>");
		String roll = request.getParameter("roll");
		out.println("<h2> Student RollNo: " + roll + "</h2>");
		String gender = request.getParameter("gender");
		out.println("<h2> Student Gender: " + gender + "</h2>");
		String year = request.getParameter("year");
		out.println("<h2> Year of Study: " + year + "</h2>");
		String dept = request.getParameter("dept");
		out.println("<h2> Department: " + dept + "</h2>");
		String sec = request.getParameter("sec");
		out.println("<h2> Section: " + sec + "</h2>");
		String mobile = request.getParameter("mobile");
		out.println("<h2> Mobile Number: " + mobile + "</h2>");
		String email = request.getParameter("email");
		out.println("<h2> Email Id: " + email + "</h2>");
		String address = request.getParameter("address");
		out.println("<h2> Address: " + address + "</h2>");
		String city = request.getParameter("city");
		out.println("<h2> City: " + city + "</h2>");
		String country = request.getParameter("country");
		out.println("<h2> Country: " + country + "</h2>");
		String pin = request.getParameter("pin");
		out.println("<h2> Pin Code: " + pin + "</h2>");
	}

}
