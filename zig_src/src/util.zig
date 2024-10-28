const std = @import("std");
const testing = std.testing;

pub fn CList(comptime T: type) type {
    return packed struct {
        ptr: *const T,
        len: usize,
    };
}

pub fn to_c_list(comptime T: type, value: anytype) CList(T) {
    return CList(T){ .ptr = &value, .len = value.len };
}
