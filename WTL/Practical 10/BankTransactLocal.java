package bankexamp;

import javax.ejb.Local;

@Local

public interface BankTransactLocal {

public int deposit(int amount);

public int withdraw(int amount);

}
