DecisionNode = {
	Branch: function() {
		var _childNodes = [];
		var _ConditionNode = null;
		return {
			addNode: function(Node) {
				_childNodes.push(Node);
				return this;
			},
			setConditionNode: function(ConditionNode) {
				_ConditionNode = ConditionNode;
				return this;
			},
			evaluate: function() {
				
			}
		};
	},
	Leaf: function() {
		var _ConditionNode = null;
		return {
			setConditionNode: function(ConditionNode) {
				_ConditionNode = ConditionNode;
				return this;
			},
			evaluate: function() {
				if (_CondtionNode == null) return this;
				if (_ConditionNode.compare()) return this;
				return null;
			}
		};
	}
};

Branch = new DecisionNode.Branch();
Branch.addNode(new DecisionNode.Leaf());
console.log(Branch);
