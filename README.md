[![Build Status](https://travis-ci.org/projx-io/collections.svg?branch=master)](https://travis-ci.org/projx-io/collections?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/projx-io/collections/badge.svg?branch=master)](https://coveralls.io/github/projx-io/collections?branch=master)

    ValueCollection
        bool    containsValue(mixed $value)
        mixed   valueOfOffset(int $offset)
        mixed[] valueOfOffsets(int[] $offsets)
        
        MutableValueCollection
            void removeOffset(int $offset)
            void removeOffsets(int[] $offsets)
            void removeValue(mixed $value)
            void removeValues(mixed[] $values)
            
        ValueSet
            int   offsetOfValue(mixed $value)
            int[] offsetOfValues(mixed[] $values)
        
            MutableValueSet
                void putValue(mixed $value)
                void putValues(mixed[] $values)
        
        ValueList
            int[]   offsetsOfValue(mixed $value)
            int[][] offsetsOfValues(mixed[] $values)

            MutableValueSet
                void addValue(mixed $value)
                void addValues(mixed[] $values)

    