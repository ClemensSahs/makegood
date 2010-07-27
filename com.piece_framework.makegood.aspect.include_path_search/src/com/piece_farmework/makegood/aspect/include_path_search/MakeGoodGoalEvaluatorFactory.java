/**
 * Copyright (c) 2010 MATSUFUJI Hideharu <matsufuji2008@gmail.com>,
 * All rights reserved.
 *
 * This file is part of MakeGood.
 *
 * This program and the accompanying materials are made available under
 * the terms of the Eclipse Public License v1.0 which accompanies this
 * distribution, and is available at http://www.eclipse.org/legal/epl-v10.html
 */

package com.piece_farmework.makegood.aspect.include_path_search;

import org.eclipse.dltk.ti.IGoalEvaluatorFactory;
import org.eclipse.dltk.ti.goals.GoalEvaluator;
import org.eclipse.dltk.ti.goals.IGoal;

public class MakeGoodGoalEvaluatorFactory implements IGoalEvaluatorFactory {
    @Override
    public GoalEvaluator createEvaluator(IGoal goal) {
        Startup startup = new Startup();
        startup.earlyStartup();

        return null;
    }
}
