package bankexamp;

import javax.ejb.Stateful;

@Stateful

public class BankTransact
implements BankTransactLocal {

int balance = 10000;

@Override

public int deposit(int amount) {

balance = balance + amount;

return balance;

}

@Override

public int withdraw(int amount) {

balance = balance - amount;

return balance;

}

}
