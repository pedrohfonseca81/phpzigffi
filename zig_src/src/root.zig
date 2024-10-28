const std = @import("std");
const testing = std.testing;
const util = @import("util.zig");

export fn add(a: i32, b: i32) i32 {
    return a + b;
}

export fn iterate_with_while(times: i64) i64 {
    var i: i64 = 0;
    var value: i64 = 0;
    while (i < times) : (i += 1) {
        value += i;
    }

    return value;
}

export fn get_array() util.CList([5]i32) {
    const array = [_]i32{ 300, 2, 3, 4, 5 };

    return util.to_c_list([5]i32, array);
}
