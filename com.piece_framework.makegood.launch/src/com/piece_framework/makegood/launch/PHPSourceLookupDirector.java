/*******************************************************************************
 * Copyright (c) 2009 IBM Corporation and others.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 * 
 * Contributors:
 *     IBM Corporation - initial API and implementation
 *     Zend Technologies
 *******************************************************************************/
package com.piece_framework.makegood.launch;

import java.util.HashMap;
import java.util.Iterator;

import org.eclipse.core.filesystem.EFS;
import org.eclipse.core.internal.filesystem.local.LocalFile;
import org.eclipse.core.internal.resources.LinkDescription;
import org.eclipse.core.internal.resources.Project;
import org.eclipse.core.internal.resources.ProjectDescription;
import org.eclipse.core.resources.IFile;
import org.eclipse.core.resources.IProject;
import org.eclipse.core.resources.IResource;
import org.eclipse.core.resources.IWorkspaceRoot;
import org.eclipse.core.resources.ResourcesPlugin;
import org.eclipse.core.runtime.CoreException;
import org.eclipse.core.runtime.IPath;
import org.eclipse.core.runtime.Path;
import org.eclipse.debug.core.model.IStackFrame;
import org.eclipse.debug.core.sourcelookup.AbstractSourceLookupDirector;
import org.eclipse.debug.core.sourcelookup.ISourceLookupParticipant;
import org.eclipse.debug.internal.ui.views.launch.SourceNotFoundEditorInput;
import org.eclipse.php.internal.debug.core.IPHPDebugConstants;
import org.eclipse.php.internal.debug.core.sourcelookup.PHPSourceLookupParticipant;

/**
 * PHP source lookup director. For PHP source lookup there is one source lookup
 * participant.
 */
public class PHPSourceLookupDirector extends AbstractSourceLookupDirector {
	/*
	 * (non-Javadoc)
	 * 
	 * @seeorg.eclipse.debug.internal.core.sourcelookup.ISourceLookupDirector#
	 * initializeParticipants()
	 */
	public void initializeParticipants() {
		addParticipants(new ISourceLookupParticipant[] { new PHPSourceLookupParticipant() });
	}

	public Object getSourceElement(Object element) {
		Object obj = super.getSourceElement(element);
		if (obj == null) {
			if (element instanceof IStackFrame) {
				obj = new SourceNotFoundEditorInput((IStackFrame) element);
			}
		}

		if (obj instanceof LocalFile && element instanceof IStackFrame) {
			IStackFrame stackFrame = (IStackFrame) element;
			LocalFile localFile = (LocalFile) obj;
			IProject project = null;
			try {
				if (stackFrame.getLaunch() != null
						&& stackFrame.getLaunch().getLaunchConfiguration() != null) {
					String file = stackFrame.getLaunch()
							.getLaunchConfiguration()
							.getAttribute(IPHPDebugConstants.ATTR_FILE,
									(String) null);
					if (file != null) {
						IWorkspaceRoot workspaceRoot = ResourcesPlugin
								.getWorkspace().getRoot();
						IResource resource = workspaceRoot.findMember(file);
						if (resource != null) {
							project = resource.getProject();
						}
					}
				}
			} catch (CoreException e1) {
			}
			if (project != null) {
				try {
					ProjectDescription desc = ((Project) project)
							.internalGetDescription();
					if (desc != null) {
						HashMap links = desc.getLinks();
						if (links != null) {

							for (Iterator<IPath> iterator = links.keySet()
									.iterator(); iterator.hasNext();) {
								IPath relativePath = iterator.next();
								LinkDescription linkDescription = (LinkDescription) links
										.get(relativePath);
								IPath linkPath = new Path(linkDescription
										.getLocationURI().getPath());
								IPath filePath = new Path(localFile
										.toLocalFile(EFS.NONE, null)
										.getAbsolutePath());
								if (linkPath.isPrefixOf(filePath)) {
									filePath = filePath.removeFirstSegments(
											linkPath.segmentCount()).setDevice(
											null);
									relativePath = relativePath
											.append(filePath);
									IFile file = project
											.getFile(relativePath);
									if (file.isAccessible()) {
										return file;
									}
								}
							}
						}

					}

				} catch (CoreException e) {
				}
			}

		}
		return obj;
	}

}
