import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.http.*;

import javax.naming.Context;
import javax.naming.InitialContext;

public class transact extends HttpServlet {

protected void doPost(
HttpServletRequest request,
HttpServletResponse response)

throws ServletException, IOException {

response.setContentType("text/html;charset=UTF-8");

PrintWriter out = response.getWriter();

try {

String type =
request.getParameter("transaction");

int amount =
Integer.parseInt(
request.getParameter("amount")
);

BankTransactLocal bank =
lookupBankTransactLocal();

int result = 0;

if ("deposit".equals(type)) {

result = bank.deposit(amount);

out.println(
"<h2>Amount Deposited Successfully</h2>"
);

}

else if ("withdraw".equals(type)) {

result = bank.withdraw(amount);

out.println(
"<h2>Amount Withdrawn Successfully</h2>"
);

}

out.println(
"<h3>Current Balance: Rs "
+ result +
"</h3>"
);

}

catch (Exception e) {

out.println("Error: " + e);

}

}

private BankTransactLocal lookupBankTransactLocal() {

try {

Context c = new InitialContext();

return (BankTransactLocal)
c.lookup(
"java:global/Bank/Bank-ejb/BankTransact!bankexamp.BankTransactLocal"
);

}

catch (Exception e) {

throw new RuntimeException(e);

}

}

}
