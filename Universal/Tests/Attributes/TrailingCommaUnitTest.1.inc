<?php

#[] // Nothing to do.

/*
 * OK, no trailing comma for single line blocks or multi-line blocks with single attribute.
 */
#[SingleAttribute]
#[SingleAttributeWithParens]
#[AttributeOne, AttributeTwo]

#[SingleAttributeInMultiLineAttributeBlock(
    paramA: 10,
    paramB: 20,
)]

#[
    SingleAttributeInMultiLineAttributeBlock()
]

/*
 * OK, trailing comma for multi-line blocks with multiple attributes.
 *
 * Note: the sniff should not care about the rest of the formatting of the attribute, we are only looking at the trailing comma.
 */
#[AttributeOne,
AttributeTwo,]

#[AttributeOne,
AttributeTwo,
]

#[
    AttributeOne,
    AttributeTwo,
]
#[
    AttributeOne(10),
    AttributeTwo(
        paramB: 20,
    ),
]
#[
    AttributeOne,
    AttributeTwo /*comment*/,
]
#[
    AttributeOne,
    AttributeTwo // comment
    ,
]

/*
 * Bad, trailing comma for single line blocks or multi-line blocks with single attribute.
 */
#[SingleAttribute,]
#[SingleAttributeWithParens   ,   ]
#[AttributeOne, AttributeTwo, ]

#[SingleAttributeInMultiLineAttributeBlock(
    paramA: 10,
    paramB: 20,
),]

#[
    SingleAttributeInMultiLineAttributeBlock(),
]

/*
 * Bad, no trailing comma for multi-line blocks with multiple attributes.
 */
#[AttributeOne,
AttributeTwo]

#[AttributeOne,
AttributeTwo
]

#[
    AttributeOne,
    AttributeTwo
]
#[
    AttributeOne(10),
    AttributeTwo(
        paramB: 20,
    )
]
#[
    AttributeOne,
    AttributeTwo /*comment*/
]
#[
    AttributeOne,
    AttributeTwo // comment
]

function foo() {}
