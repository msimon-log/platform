---
title: Use dynamic search score calculation for match segments
issue: Match segments might get too high score, determined only by the amount of segments, not of their relevance regarding the search tokens
flag:
author: Manuel Simon
author_email: manuel.simon@logmedia.at
author_github: msimon-log
---
# Core
*  score() method changed to use the levenshtein distance of each match-segment instead of just adding 4 to the score for each segment.
*  Moved the existing score calculation using the levenshtein distance into a own private method "calculateLevenshteinDistance()"
