[![Build Status](https://travis-ci.org/projx-io/collections.svg?branch=master)](https://travis-ci.org/projx-io/collections?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/projx-io/collections/badge.svg?branch=master)](https://coveralls.io/github/projx-io/collections?branch=master)

    ValueCollection
        bool    containsValue(mixed $value)
        mixed   valueOfOffset(int $offset)
        mixed[] valueOfOffsets(int[] $offsets)
        
        ValueSet
            int   offsetOfValue(mixed $value)
            int[] offsetOfValues(mixed[] $value)
        
        ValueList
            int[]   offsetsOfValue(mixed $value)
            int[][] offsetsOfValues(mixed[] $value)
