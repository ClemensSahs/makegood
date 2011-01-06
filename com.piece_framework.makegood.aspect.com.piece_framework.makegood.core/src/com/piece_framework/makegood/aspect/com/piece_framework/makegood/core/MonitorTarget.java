/**
 * Copyright (c) 2010 KUBO Atsuhiro <kubo@iteman.jp>,
 * All rights reserved.
 *
 * This file is part of MakeGood.
 *
 * This program and the accompanying materials are made available under
 * the terms of the Eclipse Public License v1.0 which accompanies this
 * distribution, and is available at http://www.eclipse.org/legal/epl-v10.html
 */

package com.piece_framework.makegood.aspect.com.piece_framework.makegood.core;

import com.piece_framework.makegood.javassist.monitor.IMonitorTarget;

/**
 * @since 1.2.0
 */
public class MonitorTarget implements IMonitorTarget {
    static boolean endWeaving = false;

    @Override
    public boolean endWeaving() {
        return MonitorTarget.endWeaving;
    }
}