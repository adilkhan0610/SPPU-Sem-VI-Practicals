package com.myapp.struts;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.struts.action.*;

public class loginform extends Action {

    private static final String SUCCESS = "success";
    private static final String FAILURE = "failure";

    @Override
    public ActionForward execute(
            ActionMapping mapping,
            ActionForm form,
            HttpServletRequest request,
            HttpServletResponse response)
            throws Exception {

        loginbean lb = (loginbean) form;

        if ("abc".equals(lb.getUname())
                && "123".equals(lb.getUpass())) {

            return mapping.findForward(SUCCESS);

        } else {

            return mapping.findForward(FAILURE);
        }
    }
}
