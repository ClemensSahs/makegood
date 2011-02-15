/**
 * Copyright (c) 2009-2010 MATSUFUJI Hideharu <matsufuji2008@gmail.com>,
 * All rights reserved.
 *
 * This file is part of MakeGood.
 *
 * This program and the accompanying materials are made available under
 * the terms of the Eclipse Public License v1.0 which accompanies this
 * distribution, and is available at http://www.eclipse.org/legal/epl-v10.html
 */

package com.piece_framework.makegood.ui.handlers;

import org.eclipse.core.commands.ExecutionEvent;
import org.eclipse.core.commands.ExecutionException;
import org.eclipse.dltk.core.IModelElement;
import org.eclipse.ui.IEditorPart;
import org.eclipse.ui.IWorkbenchPage;
import org.eclipse.ui.IWorkbenchWindow;
import org.eclipse.ui.PlatformUI;
import org.eclipse.ui.handlers.HandlerUtil;

import com.piece_framework.makegood.ui.launch.TestRunner;
import com.piece_framework.makegood.ui.views.EditorParser;

public class RunTestFromEditorInClass extends RunTestFromEditorHandler {
    @Override
    public Object execute(ExecutionEvent event) throws ExecutionException {
        TestRunner.runTestsInClass(HandlerUtil.getActiveEditor(event));
        return null;
    }

    @Override
    public boolean isEnabled() {
        if (!super.isEnabled()) return false;

        IWorkbenchWindow window = PlatformUI.getWorkbench().getActiveWorkbenchWindow();
        if (window == null) return false;
        IWorkbenchPage page = window.getActivePage();
        if (page == null) return false;
        IEditorPart editor = page.getActiveEditor();
        if (editor == null) return false;
        IModelElement element = new EditorParser(editor).getModelElementOnSelection();
        if (element.getElementType() == IModelElement.TYPE
            || element.getElementType() == IModelElement.METHOD
            || element.getElementType() == IModelElement.FIELD
            ) {
            return true;
        }

        return false;
    }
}
