#!/bin/sh

echo "Enter Message"
read Message

git add .
git status
git commit -m "$Message"
git push origin main
