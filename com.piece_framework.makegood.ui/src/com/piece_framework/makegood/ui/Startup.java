/**
 * Copyright (c) 2009-2010 MATSUFUJI Hideharu <matsufuji2008@gmail.com>,
 *               2010 KUBO Atsuhiro <kubo@iteman.jp>,
 * All rights reserved.
 *
 * This file is part of MakeGood.
 *
 * This program and the accompanying materials are made available under
 * the terms of the Eclipse Public License v1.0 which accompanies this
 * distribution, and is available at http://www.eclipse.org/legal/epl-v10.html
 */

package com.piece_framework.makegood.ui;

import org.eclipse.core.runtime.IProgressMonitor;
import org.eclipse.core.runtime.IStatus;
import org.eclipse.core.runtime.Status;
import org.eclipse.core.runtime.jobs.Job;
import org.eclipse.jface.viewers.ISelectionChangedListener;
import org.eclipse.jface.viewers.ISelectionProvider;
import org.eclipse.jface.viewers.SelectionChangedEvent;
import org.eclipse.ui.IPartListener;
import org.eclipse.ui.IStartup;
import org.eclipse.ui.IWorkbenchPage;
import org.eclipse.ui.IWorkbenchPart;
import org.eclipse.ui.IWorkbenchWindow;
import org.eclipse.ui.PlatformUI;
import org.eclipse.ui.progress.UIJob;

import com.piece_framework.makegood.ui.ide.ViewShow;
import com.piece_framework.makegood.ui.launch.AllTestsStatus;
import com.piece_framework.makegood.ui.views.ResultView;

public class Startup implements IStartup {
    @Override
    public void earlyStartup() {
        AllTestsStatus.getInstance();

        final ISelectionChangedListener listener = new ISelectionChangedListener() {
            @Override
            public void selectionChanged(SelectionChangedEvent event) {
                setEnabledRunAllTestsAction();
            }
        };
        for (IWorkbenchWindow window: PlatformUI.getWorkbench().getWorkbenchWindows()) {
            for (IWorkbenchPage page: window.getPages()) {
                page.addPartListener(new IPartListener() {
                    @Override
                    public void partActivated(IWorkbenchPart part) {
                        addSelectionChangedListener(part, listener);

                        setEnabledRunAllTestsAction();
                    }

                    @Override
                    public void partBroughtToTop(IWorkbenchPart part) {}

                    @Override
                    public void partClosed(IWorkbenchPart part) {}

                    @Override
                    public void partDeactivated(IWorkbenchPart part) {}

                    @Override
                    public void partOpened(IWorkbenchPart part) {}
                });

                addSelectionChangedListener(page.getActivePart(), listener);
            }
        }

        Job job = new UIJob("MakeGood Set Enabled RunAllTests Action") { //$NON-NLS-1$
            @Override
            public IStatus runInUIThread(IProgressMonitor monitor) {
                setEnabledRunAllTestsAction();
                return Status.OK_STATUS;
            }
        };
        job.schedule();
    }

    private void addSelectionChangedListener(IWorkbenchPart part,
                                             ISelectionChangedListener listener
                                             ) {
        ISelectionProvider provider = part.getSite().getSelectionProvider();
        if (provider != null) {
            provider.addSelectionChangedListener(listener);
        }
    }

    private void setEnabledRunAllTestsAction() {
        ResultView resultView = (ResultView) ViewShow.find(ResultView.ID);
        if (resultView != null) {
            resultView.setEnabledRunAllTestsAction(AllTestsStatus.getInstance().runnable());
        }
    }
}
