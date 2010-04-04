package com.piece_framework.makegood.core.runner;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

public class TestSuite extends TestResult {
    private String fullPackageName;
    private String packageName;
    private int testCount;
    private int errorCount;
    private int failureCount;
    private List<TestResult> children;

    public TestSuite(String name) {
        this.name = name;
        children = new ArrayList<TestResult>();
    }

    public String getFullPackageName() {
        return fullPackageName;
    }

    public String getPackageName() {
        return packageName;
    }

    public int getTestCount() {
        return testCount;
    }

    public int getErrorCount() {
        return errorCount;
    }

    public int getFailureCount() {
        return failureCount;
    }

    @Override
    public boolean hasError() {
        for (TestResult result : children) {
            if (result.hasError()) {
                return true;
            }
        }

        return errorCount > 0;
    }

    @Override
    public boolean hasFailure() {
        for (TestResult result : children) {
            if (result.hasFailure()) {
                return true;
            }
        }

        return failureCount > 0;
    }

    @Override
    public void addChild(TestResult result) {
        if (result == null) {
            return;
        }

        result.setParent(this);

        children.add(result);
    }

    @Override
    public List<TestResult> getChildren() {
        return Collections.unmodifiableList(children);
    }

    @Override
    public TestResult getChild(String name) {
        for (TestResult result: children) {
            if (result.getName().equals(name)) {
                return result;
            }
        }

        return null;
    }

    public void increaseFailureCount() {
        ++failureCount;
        if (getParent() != null) {
            ((TestSuite)getParent()).increaseFailureCount();
        }
    }

    public void increaseErrorCount() {
        ++errorCount;
        if (getParent() != null) {
            ((TestSuite)getParent()).increaseErrorCount();
        }
    }

    @Override
    public void setTime(long time) {
        this.time += time;
        if (getParent() != null) {
            getParent().setTime(time);
        }
    }

    public void setFullPackageName(String fullPackage) {
        this.fullPackageName = fullPackage;
    }

    public void setPackageName(String packageName) {
        this.packageName = packageName;
    }

    public void setTestCount(int testCount) {
        this.testCount = testCount;
    }
}